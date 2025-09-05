<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('candidate.user.index');
    }

    public function store(Request $request)
    {
        $user = User::find(auth()->guard('user')->id());

        if ($request->has('professional_skill')) {
            $request->validate([
                'professional_skill' => 'required',
                'year' => 'required|numeric'
            ]);
            $user->professionalSkills()->create($request->all());
            return back()->with('success', __('create professional skill is success'));
        }

        if ($request->has('work_experience')) {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'nullable|date',
                'company' => 'required',
                'work_experience' => 'required|min:10',
            ]);
            $user->workExperiences()->create($request->all());
            return back()->with('success', __('create work experience is success'));
        }

        // Learning process
        if ($request->has('learning_process')) {
            $request->validate([
                'year' => 'required|numeric',
                'school' => 'required',
                'degree' => 'required',
                'specialized' => 'required',
            ]);
            $user->learningProcesses()->create($request->all());
            return back()->with('success', __('create learning process is success'));
        }

        // Language
        if ($request->has('language')) {
            $request->validate([
                'language' => 'required',
                'proficient' => 'required',
            ]);
            $user->languages()->create($request->all());
            return back()->with('success', __('create language is success'));
        }

        // Soft skill
        if ($request->has('soft_skill')) {
            $request->validate([
                'soft_skill' => 'required',
                'proficient' => 'required',
            ]);
            $user->softSkills()->create($request->all());
            return back()->with('success', __('create soft skill is success'));
        }

        // Hobby
        if ($request->has('hobby')) {
            $request->validate([
                'hobby' => 'required',
            ]);
            $user->hobbies()->create($request->all());
            return back()->with('success', __('create hobby is success'));
        }

        // Desired location
        if ($request->has('desired_location')) {
            $request->validate([
                'desired_location' => 'required',
            ]);
            $user->desiredLocations()->create($request->all());
            return back()->with('success', __('create desired location is success'));
        }

        // Attachment
        if ($request->has('attachment')) {
            $request->validate([
                'attachment' => 'required',
                'file' => 'required|file',
            ]);
            $attachment = $request->attachment;

            $file = $request->file('file');
            $fileName = $user->id . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/file/attachment'), $fileName);

            $link = 'storage/file/attachment/' . $fileName;
            $user->attachments()->create([
                'attachment' => $attachment,
                'link' => $link
            ]);
            return back()->with('success', __('create attachment is success'));
        }

        // Certificate
        if ($request->has('certificate')) {
            $request->validate([
                'certificate' => 'required',
                'file' => 'required|file',
            ]);
            $certificate = $request->certificate;

            $file = $request->file('file');
            $fileName = $user->id . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/file/certificate'), $fileName);

            $link = 'storage/file/certificate/' . $fileName;
            $user->certificates()->create([
                'certificate' => $certificate,
                'link' => $link
            ]);
            return back()->with('success', __('create certificate is success'));
        }

        return back()->with('error', __('did not things'));
    }

    public function edit(string $id)
    {
        return view('candidate.user.edit');
    }

    public function update(Request $request, string $id)
    {
        $auth = User::find(auth()->guard('user')->id());

        //password
        if ($request->has('new_password')) {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);
            // Kiểm tra mật khẩu hiện tại
            if (!Hash::check($request->current_password, $auth->password)) {
                return back()->with('error', __('current password is incorrect'));
            }

            // Cập nhật mật khẩu mới
            $auth->password = Hash::make($request->new_password);
            $auth->save();

            return back()->with('success', __('change password is success'));
        }
        //image
        if ($request->hasFile('new_image')) {
            $request->validate([
                'new_image' => 'required|image',
            ]);

            $image = $request->file('new_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/image/user'), $imageName);

            unlink(public_path($auth->image));

            $auth->image = "storage/image/user/" . $imageName;
            $auth->save();

            return back()->with('success', __('change image is success'));
        }
        //name
        if ($request->has('new_name')) {
            $request->validate([
                'new_name' => 'required',
            ]);

            $auth->name = $request->new_name;
            $auth->save();

            return back()->with('success', __('change name is success'));
        }
        //date of birth
        if ($request->has('new_date_of_birth')) {
            $request->validate([
                'new_date_of_birth' => 'required|date',
            ]);

            $auth->date_of_birth = $request->new_date_of_birth;
            $auth->save();

            return back()->with('success', __('change date of birth is success'));
        }
        //sex
        if ($request->has('new_sex')) {
            $request->validate([
                'new_sex' => 'required',
            ]);

            $auth->sex = $request->new_sex;
            $auth->save();

            return back()->with('success', __('change sex is success'));
        }
        //desired_location
        if ($request->has('new_desired_location')) {
            $request->validate([
                'new_desired_location' => 'required',
            ]);

            $auth->desired_location = $request->new_desired_location;
            $auth->save();

            return back()->with('success', __('change desired location is success'));
        }
        //position
        if ($request->has('new_position')) {
            $request->validate([
                'new_position' => 'required',
            ]);

            $auth->position = $request->new_position;
            $auth->save();

            return back()->with('success', __('change position is success'));
        }
        //job_search_status
        if ($request->has('new_job_search_status')) {
            $request->validate([
                'new_job_search_status' => 'required',
            ]);

            $auth->job_search_status = $request->new_job_search_status;
            $auth->save();

            return back()->with('success', __('change job search status is success'));
        }
        //introduce
        if ($request->has('new_introduce')) {
            $request->validate([
                'new_introduce' => 'required',
            ]);

            $auth->introduce = $request->new_introduce;
            $auth->save();

            return back()->with('success', __('change introduce is success'));
        }

        // phone
        if ($request->has('new_phone')) {
            $request->validate([
                'new_phone' => 'required',
            ]);

            $auth->phone = $request->new_phone;
            $auth->save();

            return back()->with('success', __('change phone is success'));
        }

        // address
        if ($request->has('new_address')) {
            $request->validate([
                'new_address' => 'required',
            ]);

            $auth->address = $request->new_address;
            $auth->save();

            return back()->with('success', __('change address is success'));
        }

        // location
        if ($request->has('new_location')) {
            $request->validate([
                'new_location' => 'required',
            ]);

            $auth->location = $request->new_location;
            $auth->save();

            return back()->with('success', __('change location is success'));
        }

        // degree
        if ($request->has('new_degree')) {
            $request->validate([
                'new_degree' => 'required',
            ]);

            $auth->degree = $request->new_degree;
            $auth->save();

            return back()->with('success', __('change degree is success'));
        }

        // current_salary
        if ($request->has('new_current_salary')) {
            $request->validate([
                'new_current_salary' => 'required|numeric',
            ]);

            $auth->current_salary = $request->new_current_salary;
            $auth->save();

            return back()->with('success', __('change current salary is success'));
        }

        // desired_salary
        if ($request->has('new_desired_salary')) {
            $request->validate([
                'new_desired_salary' => 'required|numeric',
            ]);

            $auth->desired_salary = $request->new_desired_salary;
            $auth->save();

            return back()->with('success', __('change desired salary is success'));
        }
        return back()->with('error', __('did not things'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $user = User::find(auth()->guard('user')->id());

        // Xóa Professional Skill
        if ($request->has('professional_skill')) {
            $user->professionalSkills()->find($request->professional_skill)->delete();
            return back()->with('success', __('delete professional skill is success'));
        }

        // Xóa Work Experience
        if ($request->has('work_experience')) {
            $user->workExperiences()->find($request->work_experience)->delete();
            return back()->with('success', __('delete work experience is success'));
        }

        // Xóa Learning Process
        if ($request->has('learning_process')) {
            $user->learningProcesses()->find($request->learning_process)->delete();
            return back()->with('success', __('delete learning process is success'));
        }

        // Xóa Language
        if ($request->has('language')) {
            $user->languages()->find($request->language)->delete();
            return back()->with('success', __('delete language is success'));
        }

        // Xóa Soft Skill
        if ($request->has('soft_skill')) {
            $user->softSkills()->find($request->soft_skill)->delete();
            return back()->with('success', __('delete soft skill is success'));
        }

        // Xóa Hobby
        if ($request->has('hobby')) {
            $user->hobbies()->find($request->hobby)->delete();
            return back()->with('success', __('delete hobby is success'));
        }

        // Xóa Desired Location
        if ($request->has('desired_location')) {
            $user->desiredLocations()->find($request->desired_location)->delete();
            return back()->with('success', __('delete desired location is success'));
        }

        // Xóa Attachment
        if ($request->has('attachment')) {
            $attachment = $user->attachments()->find($request->attachment);
            if ($attachment) {
                // Xóa file vật lý
                $filePath = public_path($attachment->link);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $attachment->delete();
            }
            return back()->with('success', __('delete attachment is success'));
        }

        // Xóa Certificate
        if ($request->has('certificate')) {
            $certificate = $user->certificates()->find($request->certificate);
            if ($certificate) {
                // Xóa file vật lý
                $filePath = public_path($certificate->link);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $certificate->delete();
            }
            return back()->with('success', __('delete certificate is success'));
        }

        return back()->with('error', __('no valid delete action found'));
    }
}
