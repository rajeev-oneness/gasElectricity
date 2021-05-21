<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Testimonials;use App\Model\BlogCategory;
use App\Model\Faq;use App\Model\Blog;use Auth;
use App\Model\ContactUs;use App\Model\Membership;
use App\Model\UserMembership;use App\Model\Setting;
use App\Model\Product;

class WelcomeController extends Controller
{
    public function index(Request $req)
    {
        $data = new WelcomeController();
        $data->testimonials = Testimonials::get();
        $data->faq = Faq::get();
        $data->blogs = Blog::limit(5)->get();
    	return view('welcome',compact('data'));
    }

    public function aboutUs(Request $req)
    {
        $data = (object)[];
        $data->aboutus = Setting::where('key','about_us')->first();
        $data->whychooseus = Setting::where('key','whychooseus')->get();
    	return view('frontend.about-us',compact('data'));
    }

    public function howItWorks(Request $req)
    {
    	return view('frontend.howItWorks');
    }

    public function getBlogs(Request $req)
    {
        $data = new WelcomeController();
        $data->category = BlogCategory::get();
        $data->blogs = Blog::with('posted')->with('likes')->with('comment');
        if(!empty($req->category)){
            $data->blogs = $data->blogs->where('blogCategoryId',base64_decode($req->category));    
        }
        $data->blogs = $data->blogs->orderBy('id','desc')->get();
        return view('frontend.blog',compact('data'));
    }

    public function blogDetails(Request $req,$blogId)
    {
        $data = new WelcomeController();
        $data->category = BlogCategory::get();
        $data->blogs = Blog::where('id',$blogId)->with('posted')->first();
        return view('frontend.blogdetails',compact('data'));
    }

    public function contactUs(Request $req)
    {
        $contact = ContactUs::where('type',1)->first();
        return view('frontend.contactus',compact('contact'));
    }

    public function saveContactUs(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits:10|numeric',
            'email' => 'required|email|max:255|string',
            'message' => 'required|string',
        ]);
        $contact = new ContactUs();
        $contact->type = 2;
        $contact->name = $req->name;
        $contact->phone = $req->phone;
        $contact->email = $req->email;
        $contact->subject = '';
        $contact->description = $req->message;
        $contact->save();
        $sucess['msg'] = 'Thankyou for contact with us, we will guide you soon!';
        return back()->withErrors($sucess);
    }

    public function planListing(Request $req)
    {
        if(auth()->user())
            return $this->planListingwithAuth($req);
        else
            return $this->planListingwithoutAuth($req);
    }

    public function getPlanlistingData(Request $req)
    {
        $productData = Product::paginate(10);
        return $productData;
    }

    public function planListingwithoutAuth(Request $req)
    {
        $productData = $this->getPlanlistingData($req);
        return view('frontend.listing.planWithoutLogin', compact('productData'));
    }

    public function planListingwithAuth(Request $req)
    {
        $productData = $this->getPlanlistingData($req);
        return view('frontend.listing.planWithLogin', compact('productData'));
    }

    public function planDetails(Request $req,$planId)
    {
        $productData = Product::findOrFali($planId);
        return view('frontend.listing.plan_details', compact('productData'));
    }

    public function electricityForm(Request $req)
    {
        return view('frontend.forms.electricityForm');
    }

    public function indivisualStates(Request $req)
    {
        $data = (object)[];
        $data->whychooseus = Setting::where('key','whychooseus')->get();
        return view('frontend.forms.indivisualStates',compact('data'));
    }

    public function membership(Request $req)
    {
        $membership = Membership::get();
        return view('frontend.membership',compact('membership'));
    }

    public function purchaseMembership(Request $req,$membershipId)
    {
        $membership = Membership::where('id',base64_decode($membershipId))->first();
        $data = [
            'redirectUrl' => route('membership.claimed.success',$membership->id),
            'price' => $membership->price,
        ];
        return view('stripe.index',compact('data'));
    }

    public function membershipSuccessFullPurchase(Request $req,$membershipId)
    {
        $userMembership = new UserMembership();
        $userMembership->userId = auth()->user()->id;
        $userMembership->membershipId = $membershipId;
        $userMembership->stripeTransactionId = $req->stripeTransactionId;
        $userMembership->save();
        return redirect(route('payment.successfull.thankyou',$req->stripeTransactionId));
    }
    
}
