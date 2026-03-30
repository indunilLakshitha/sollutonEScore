<?php

namespace App\Livewire\Home;

use App\Models\Course;
use Livewire\Component;

class Index extends Component
{

    public $courses, $course_id;

    public function mount()
    {
        $this->courses = Course::with('category')->where('has_website', 1)->get();
    }

    public function render()
    {
        return view('livewire.home.index');
    }

    public function selectCourse($course_id)
    {
        return redirect()->route('regWithcourse', [$course_id]);
    }
}
