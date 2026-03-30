<?php

namespace App\Http\Controllers;

use App\Models\DashboardCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IndexPageController extends Controller
{
    public function index()
    {

        return view('home.index');
    }

    public function courses()
    {
        $ref = null;
        return view('home.courses', compact('ref'));
    }

    public function coursesWithReferrel($ref)
    {

        return view('home.courses', compact('ref'));
    }

    public function registerWithRef($ref, $course)
    {
        return view('home.register', compact('ref', 'course'));
    }

    public function register()
    {
        $ref = null;
        $course = null;
        return view('home.register', compact('ref', 'course'));
    }

    public function regWithcourse($course)
    {
        $ref = null;
        return view('home.register', compact('ref', 'course'));
    }

    public function checkout($user_id)
    {

        return view('home.checkout', compact('user_id'));
    }

    public function contactUs()
    {
        return view('home.contact-us');
    }

    public function ourTeam()
    {
        return view('home.our-team');
    }

    public function aboutUs()
    {
        return view('home.about-us');
    }

    public function thankYou($user_id)
    {
        return view('home.thank-you', compact('user_id'));
    }

    public function courseDetail($course_id)
    {
        return view('home.course-detail', compact('course_id'));
    }

    public function termsNConditn()
    {
        return view('home.termsNc');
    }

    public function pp()
    {
        return view('home.privacy-policy');
    }

    public function getCities(Request $request)
    {
        try {
            $districtId = $request->input('district_id');

            if (empty($districtId)) {
                return response()->json(['cities' => []], 200);
            }

            $cities = DashboardCity::where('district_id', $districtId)
                ->select('id', 'name_en')
                ->get()
                ->map(function($city) {
                    return [
                        'id' => $city->id,
                        'name_en' => $city->name_en
                    ];
                });

            return response()->json([
                'success' => true,
                'cities' => $cities
            ], 200)->header('Content-Type', 'application/json')
                    ->header('X-Content-Type-Options', 'nosniff');
        } catch (\Exception $e) {
            Log::error('Error in getCities: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error loading cities',
                'cities' => []
            ], 500);
        }
    }
}
