<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::find(auth('api')->id());

        if (!$user) {
            return response()->json(['errors' => ['Không tìm thấy người dùng']], 404);
        }
        
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'date_of_birth' => $user->date_of_birth,
            'sex' => $user->sex,
            'desired_location' => $user->desired_location,
            
            'job_search_status' => $user->job_search_status,
            'updated_at' => $user->updated_at,
            
            'email' => $user->email,
            'introduce' => $user->introduce,
            'phone' => $user->phone,
            'address' => $user->address,
            'position' => $user->position,
            'degree' => $user->degree,
            'current_salary' => $user->current_salary,
            'desired_salary' => $user->desired_salary,

            'professional_skills' => $user->professionalSkills,
            'work_experiences' => $user->workExperiences,
            'learning_processes' => $user->learningProcesses,
            'languages' => $user->languages,
            'soft_skills' => $user->softSkills,
            'hobbies' => $user->hobbies,
            'desired_locations' => $user->desiredLocations,
            'attachments' => $user->attachments,
            'certificates' => $user->certificates,
        ]);
    }

public function store(Request $request)
{
    $user = User::find(auth('api')->id());

    if ($request->has('professional_skill')) {
        $request->validate([
            'professional_skill' => 'required',
            'year' => 'required|numeric'
        ]);
        $user->professionalSkills()->create($request->all());
        return response()->json(['message' => __('create professional skill is success')]);
    }

    if ($request->has('work_experience')) {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'company' => 'required',
            'work_experience' => 'required|min:10',
        ]);
        $user->workExperiences()->create($request->all());
        return response()->json(['message' => __('create work experience is success')]);
    }

    if ($request->has('learning_process')) {
        $request->validate([
            'year' => 'required|numeric',
            'school' => 'required',
            'degree' => 'required',
            'specialized' => 'required',
        ]);
        $user->learningProcesses()->create($request->all());
        return response()->json(['message' => __('create learning process is success')]);
    }

    if ($request->has('language')) {
        $request->validate([
            'language' => 'required',
            'proficient' => 'required',
        ]);
        $user->languages()->create($request->all());
        return response()->json(['message' => __('create language is success')]);
    }

    if ($request->has('soft_skill')) {
        $request->validate([
            'soft_skill' => 'required',
            'proficient' => 'required',
        ]);
        $user->softSkills()->create($request->all());
        return response()->json(['message' => __('create soft skill is success')]);
    }

    if ($request->has('hobby')) {
        $request->validate([
            'hobby' => 'required',
        ]);
        $user->hobbies()->create($request->all());
        return response()->json(['message' => __('create hobby is success')]);
    }

    if ($request->has('desired_location')) {
        $request->validate([
            'desired_location' => 'required',
        ]);
        $user->desiredLocations()->create($request->all());
        return response()->json(['message' => __('create desired location is success')]);
    }

    if ($request->has('attachment')) {
        $request->validate([
            'attachment' => 'required',
            'file' => 'required|file',
        ]);
        $file = $request->file('file');
        $fileName = $user->id . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('storage/file/attachment'), $fileName);

        $link = 'storage/file/attachment/' . $fileName;
        $user->attachments()->create([
            'attachment' => $request->attachment,
            'link' => $link
        ]);
        return response()->json(['message' => __('create attachment is success')]);
    }

    if ($request->has('certificate')) {
        $request->validate([
            'certificate' => 'required',
            'file' => 'required|file',
        ]);
        $file = $request->file('file');
        $fileName = $user->id . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('storage/file/certificate'), $fileName);

        $link = 'storage/file/certificate/' . $fileName;
        $user->certificates()->create([
            'certificate' => $request->certificate,
            'link' => $link
        ]);
        return response()->json(['message' => __('create certificate is success')]);
    }

    return response()->json(['errors' => ['Không làm gì cả']], 400);
}

public function update(Request $request, string $id)
{

    $auth = User::find(auth('api')->id());

    if ($request->has('new_password')) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);
        if (!Hash::check($request->current_password, $auth->password)) {
            return response()->json(['message' => __('current password is incorrect')], 400);
        }
        $auth->password = Hash::make($request->new_password);
        $auth->save();
        return response()->json(['message' => __('change password is success')]);
    }

    if ($request->hasFile('new_image')) {
        $request->validate([
            'new_image' => 'required|image',
        ]);
        $image = $request->file('new_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('storage/image/user'), $imageName);

        if ($auth->image && file_exists(public_path($auth->image))) {
            unlink(public_path($auth->image));
        }

        $auth->image = "storage/image/user/" . $imageName;
        $auth->save();
        return response()->json(['message' => __('change image is success')]);
    }

    $fields = [
        'new_name' => 'name',
        'new_date_of_birth' => 'date_of_birth',
        'new_sex' => 'sex',
        'new_desired_location' => 'desired_location',
        'new_position' => 'position',
        'new_job_search_status' => 'job_search_status',
        'new_introduce' => 'introduce',
        'new_phone' => 'phone',
        'new_address' => 'address',
        'new_location' => 'location',
        'new_degree' => 'degree',
        'new_current_salary' => 'current_salary',
        'new_desired_salary' => 'desired_salary',
    ];

    foreach ($fields as $input => $column) {
        if ($request->has($input)) {
            $auth->$column = $request->$input;
            $auth->save();
            return response()->json(['message' => "Cập nhập thành công"]);
        }
    }

    if ($request->has('soft_skill_id')) {
        $auth->softSkills()->where('id', $request->soft_skill_id)->update(['proficient' => $request->proficient]);
        return response()->json(['message' => 'Cập nhập thành công']);
    }
    if ($request->has('language_id')) {
        $auth->languages()->where('id', $request->language_id)->update(['proficient' => $request->proficient]);
        return response()->json(['message' => 'Cập nhập thành công']);
    }
    if ($request->has('professional_skill_id')) {
        $auth->professionalSkills()->where('id', $request->professional_skill_id)->update(['year' => $request->year]);
        return response()->json(['message' => 'Cập nhập thành công']);
    }
    

    return response()->json(['errors' => ['Không làm gì cả']], 400);
}
public function destroy(Request $request, string $id)
{
    $user = User::find(auth('api')->id());

    if ($request->has('professional_skill_id')) {
        $user->professionalSkills()->where('id',$request->professional_skill_id)?->delete();
        return response()->json(['message' => 'Xóa thành công']);
    }

    if ($request->has('work_experience_id')) {
        $user->workExperiences()->where('id',$request->work_experience_id)?->delete();
        return response()->json(['message' => 'Xóa thành công']);
    }

    if ($request->has('learning_process_id')) {
        $user->learningProcesses()->where('id',$request->learning_process_id)?->delete();
        return response()->json(['message' => 'Xóa thành công']);
    }

    if ($request->has('language_id')) {
        $user->languages()->where('id',$request->language_id)?->delete();
        return response()->json(['message' => 'Xóa thành công']);
    }

    if ($request->has('soft_skill_id')) {
        $user->softSkills()->where('id',$request->soft_skill_id)?->delete();
        return response()->json(['message' => 'Xóa thành công']);
    }

    if ($request->has('hobby_id')) {
        $user->hobbies()->where('id',$request->hobby_id)?->delete();
        return response()->json(['message' => 'Xóa thành công']);
    }

    if ($request->has('desired_location_id')) {
        $user->desiredLocations()->where('id',$request->desired_location_id)?->delete();
        return response()->json(['message' => 'Xóa thành công']);
    }

    if ($request->has('attachment_id')) {
        $attachment = $user->attachments()->find($request->attachment_id);
        if ($attachment) {
            $filePath = public_path($attachment->link);
            if (file_exists($filePath)) unlink($filePath);
            $attachment->delete();
        }
        return response()->json(['message' => __('delete attachment is success')]);
    }

    if ($request->has('certificate_id')) {
        $certificate = $user->certificates()->find($request->certificate_id);
        if ($certificate) {
            $filePath = public_path($certificate->link);
            if (file_exists($filePath)) unlink($filePath);
            $certificate->delete();
        }
        return response()->json(['message' => __('delete certificate is success')]);
    }

    return response()->json(['errors' => ['Không làm gì cả']], 400);
}


}
