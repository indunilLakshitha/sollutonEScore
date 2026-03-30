<?php

namespace App\Traits;

use App\Models\UserPuchasedCourse;


trait CourseTrait
{
    public function setApplliedCourse(
        string $userId,
        string $courseId,
        string $type,
        string $purchasedPercent,
    ): UserPuchasedCourse {

        $course = new UserPuchasedCourse();
        $course->user_id =  $userId;
        $course->course_id =  $courseId;
        $course->type =  $type;
        $course->status =  UserPuchasedCourse::STATUS['APPLIED'];
        $course->purchased_percent =  $purchasedPercent;
        $course->save();

        return $course;
    }

    public function updateApplliedCourse(
        UserPuchasedCourse $userPurchased,
        string $purchasedPercent,
    ): UserPuchasedCourse {

        $userPurchased->purchased_percent =  $purchasedPercent;
        $userPurchased->save();

        return $userPurchased;
    }
}
