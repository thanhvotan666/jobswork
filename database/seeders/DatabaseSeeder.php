<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\CustomerCare;
use App\Models\Employer;
use App\Models\Footer;
use App\Models\Job;
use App\Models\JobProfession;
use App\Models\JobSkill;
use App\Models\LocationSelect;
use App\Models\LogService;
use App\Models\PaymentInfo;
use App\Models\Profession;
use App\Models\ProfessionalSkill;
use App\Models\Service;
use App\Models\ServiceRegistration;
use App\Models\Support;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $locationSelect = [
            ['location' => 'Hồ Chí Minh'],
            ['location' => 'Hà Nội'],
            ['location' => 'Đà Nẵng'],
            ['location' => 'Cần Thơ'],
            ['location' => 'Bình Dương'],
            ['location' => 'Hải Phòng'],
            ['location' => 'Đồng Nai'],
            ['location' => 'Quảng Ninh'],
        ];
        foreach ($locationSelect as $location) {
            LocationSelect::create($location);
        }
        $professions = [
            ['name' => 'Điện/Điện Tử/Điện Lạnh'],
            ['name' => 'IT Phần Mềm'],
            ['name' => 'IT Phần Cứng'],
            ['name' => 'Thiết Kế'],
            ['name' => 'Marketing'],
            ['name' => 'Truyền Thông/PR/Quảng Cáo'],
            ['name' => 'Kinh Doanh/Bán Hàng'],
            ['name' => 'Nhân Sự'],
            ['name' => 'Hành Chính/Văn Phòng'],
            ['name' => 'Lao Động Phổ Thông'],
            ['name' => 'Bán Sỉ/Bán Lẻ/Cửa Hàng'],
            ['name' => 'Đấu Thầu/Dự Án'],
            ['name' => 'Xuất Nhập Khẩu'],
            ['name' => 'Bảo Hiểm'],
            ['name' => 'Bất Động Sản'],
            ['name' => 'Nhà Hàng/Khách Sạn'],
            ['name' => 'Cơ Khí/Ô Tô/Tự Động Hóa'],
            ['name' => 'Spa/Làm Đẹp'],
            ['name' => 'Y Tế'],
            ['name' => 'Mỏ/Địa Chất'],
            ['name' => 'An Toàn Lao Động'],
            ['name' => 'Biên Phiên Dịch'],
            ['name' => 'Viễn Thông'],
            ['name' => 'Tài Chính/Ngân Hàng'],
            ['name' => 'Du Lịch'],
            ['name' => 'Giáo Dục/Đào Tạo'],
            ['name' => 'In Ấn/Chế Bản'],
            ['name' => 'Kế Toán/Kiểm Toán'],
            ['name' => 'Kiến Trúc/Nội Thất'],
            ['name' => 'Môi Trường'],
            ['name' => 'Sản Xuất/Lắp Ráp/Chế Biến'],
            ['name' => 'Nông/Lâm/Ngư Nghiệp'],
            ['name' => 'Luật/Pháp Chế'],
            ['name' => 'Kho Vận'],
            ['name' => 'Xây Dựng'],
            ['name' => 'Dệt May/Da Giày'],
            ['name' => 'Chăm Sóc Khách Hàng'],
            ['name' => 'Truyền Hình/Báo Chí'],
            ['name' => 'Thu Mua'],
            ['name' => 'Quản Lý'],
            ['name' => 'Hoá Sinh'],
            ['name' => 'Vận Hành/Bảo Trì/Bảo Dưỡng'],
            ['name' => 'Khoa Học/Kỹ Thuật'],
            ['name' => 'Dược Phẩm/Mỹ Phẩm'],
            ['name' => 'Sáng Tạo/Nghệ Thuật'],
        ];
        foreach ($professions as $profession) {
            Profession::create($profession);
        }
        Admin::create(
            [
                'name' => 'Admin',
                'image' => 'storage/image/admin/image.png',
                'email' => 'thanhvotan666@gmail.com',
                'password' => Hash::make('123123123'),
                'admin' => '1',
                'service' => '1',
                'candidate' => '1',
                'employer' => '1',
            ]
        );
        $employers = [
            [
                'name' => 'Công ty Cổ phần Vingroup',
                'image' => 'storage/image/employer/1736235170.webp',
                'email' => 'thanhvotan666@gmail.com',
                'password' => Hash::make('123123123'),
                'phone' => '12345678891',
                'register_name' => 'employer1',
                'address' => 'Hồ Chí Minh',
                'tax_code' => '12312321312'
            ],
            [
                'name' => 'Công ty Cổ phần Tập đoàn Hòa Phát',
                'image' => 'storage/image/employer/1736240453.webp',
                'email' => 'employer1@gmail.com',
                'password' => Hash::make('123123123'),
                'phone' => '091111111',
                'register_name' => 'employer1',
                'address' => 'Hồ Chí Minh',
                'tax_code' => NULL,
            ],
            [
                'name' => 'Công ty Cổ phần Sữa Việt Nam (Vinamilk)',
                'image' => 'storage/image/employer/1736240470.webp',
                'email' => 'employer2@gmail.com',
                'password' => Hash::make('123123123'),
                'phone' => '091111112',
                'register_name' => 'employer2',
                'address' => 'Hà Nội',
                'tax_code' => NULL,
            ],
            [
                'name' => 'Tập đoàn FPT',
                'image' => 'storage/image/employer/1736240489.webp',
                'email' => 'employer3@gmail.com',
                'password' => Hash::make('123123123'),
                'phone' => '0911706092',
                'register_name' => 'employer2',
                'address' => 'Đà Nẵng',
                'tax_code' => NULL,
            ],
            [
                'name' => 'Tập đoàn Công nghiệp - Viễn thông Quân đội (Viettel)',
                'image' => 'storage/image/employer/1736240527.webp',
                'email' => 'employer4@gmail.com',
                'password' => Hash::make('123123123'),
                'phone' => '091111114',
                'register_name' => 'employer4',
                'address' => 'Cần Thơ',
                'tax_code' => NULL,
            ],
            [
                'name' => 'Ngân hàng TMCP Ngoại thương Việt Nam (Vietcombank)',
                'image' => 'storage/image/employer/1736240545.webp',
                'email' => 'employer5@gmail.com',
                'password' => Hash::make('123123123'),
                'phone' => '091111115',
                'register_name' => 'employer',
                'address' => 'Bình Dương',
                'tax_code' => NULL,
            ],
            [
                'name' => 'Công ty Cổ phần Tập đoàn Masan',
                'image' => 'storage/image/employer/1736240561.webp',
                'email' => 'employer6@gmail.com',
                'password' => Hash::make('123123123'),
                'phone' => '091111116',
                'register_name' => 'employer',
                'address' => 'Bình Dương',
                'tax_code' => NULL,
            ],
            [
                'name' => 'Tập đoàn Bưu chính Viễn thông Việt Nam (VNPT)',
                'image' => 'storage/image/employer/1736240577.webp',
                'email' => 'employer7@gmail.com',
                'password' => Hash::make('123123123'),
                'phone' => '091111117',
                'register_name' => 'employer',
                'address' => 'Hải Phòng',
                'tax_code' => NULL,
            ],
            [
                'name' => 'Ngân hàng TMCP Đầu tư và Phát triển Việt Nam (BIDV)',
                'image' => 'storage/image/employer/1736240597.webp',
                'email' => 'employer8@gmail.com',
                'password' => Hash::make('123123123'),
                'phone' => '091111118',
                'register_name' => 'employer',
                'address' => 'Đồng Nai',
                'tax_code' => NULL,
            ],
            [
                'name' => 'Công ty Cổ phần Tập đoàn Vàng bạc Đá quý DOJI',
                'image' => 'storage/image/employer/1736240610.webp',
                'email' => 'employer9@gmail.com',
                'password' => Hash::make('123123123'),
                'phone' => '091111113',
                'register_name' => 'employer9',
                'address' => 'Quảng Ninh',
                'tax_code' => NULL,
            ],
        ];
        foreach ($employers as $employer) {
            Employer::create($employer);
        }
        CustomerCare::create([
            'id' => 1,
            'name' => 'Nguyễn Văn Thành',
            'email' => 'cskh@jobswork.vn',
            'phone' => '0911779923',
        ]);
        Service::create([
            'id' => 1,
            'admin_id' => 1,
            'name' => 'standard',
            'show_contact_candidate' => 1,
            'price' => '1000000',
        ]);
        Service::create([
            'id' => 2,
            'admin_id' => 1,
            'name' => 'vip 1',
            'show_contact_candidate' => 1,
            'price' => '3000000',
        ]);

        $employers = Employer::all();
        foreach ($employers as $employer) {
            ServiceRegistration::create([
                'employer_id'=> $employer->id,
                'service_id'=> 1,
                'expired' => now()->addWeek(),
            ]);
            LogService::create([
                'employer_id'=> $employer->id,
                'service_id'=> 1,
                'start' => now(),
                'expired' => now()->addWeek(),
            ]);
            Support::create([
                'employer_id' => $employer->id,
                'customer_care_id' => 1,
            ]);
            $jobs = Job::factory(['employer_id' => $employer->id])
                ->count(8) // Số lượng muốn tạo
                ->create();

            foreach ($jobs as $job) {
                JobProfession::factory()->count(random_int(1, 3))->create(['job_id' => $job->id]);
                JobSkill::factory()->count(random_int(1, 3))->create(['job_id' => $job->id]);
            }
        }
        $arrayUser = [
            'id'=> 1,
            'name'=> 'Thành',
            'image'=> 'storage/image/user/image-1735264910.png',
            'email'=> 'thanhvotan666@gmail.com',
            'phone'=> '0911776622',
            'password'=> Hash::make('123123123'),
            'date_of_birth'=> '1999-06-22',
            'sex'=> 'male',
            'position'=> 'Nhân viên',
            'introduce'=> 'Tôi là Thành',
            'desired_location'=> 'Hồ Chí Minh',
            'job_search_status'=> '1',
            'address'=> 'Ninh Kiều, Cần Thơ',
            'location'=> 'Cần Thơ',
            'degree'=> 'Đại học',
            'current_salary'=> '10000000',
            'desired_salary'=> '20000000',
        ];
        $user = User::create($arrayUser);
        $professional_skills = [
            ['professional_skill' => 'HTML','year'=>'1'],
            ['professional_skill' => 'CSS','year'=>'1'],
            ['professional_skill' => 'JavaScript','year'=>'1'],
            ['professional_skill' => 'PHP','year'=>'1'],
            ['professional_skill' => 'Laravel','year'=>'1'],
            ['professional_skill' => 'React','year'=>'0'],
        ];
        foreach ($professional_skills as $skill) {
            $user->professionalSkills()->create($skill);
        }
        $work_experiences = [
            ['start_date'=> '2021-06-21','end_date'=> '2024-06-21','company'=> 'Công ty TNHH ABC','work_experience'=> 'Làm việc tại công ty ABC'],
        ];
        foreach ($work_experiences as $skill) {
            $user->workExperiences()->create($skill);
        };
        $learning_processes = [
            ['year'=> 2024,'school'=> 'Can Tho College','degree'=>'College','specialized'=>'Information Technology'],
        ];
        foreach ($learning_processes as $process) {
            $user->learningProcesses()->create($process);
        };
        $languages = [
            ['language'=> 'English','proficient'=>'basic'],
        ];
        foreach ($languages as $language) {
            $user->languages()->create($language);
        };
        $soft_skills = [
            ['soft_skill'=> 'Teamwork','proficient'=>'basic'],
            ['soft_skill'=> 'Communication','proficient'=>'basic'],
        ];
        foreach ($soft_skills as $skill) {
            $user->softSkills()->create($skill);
        };
        $hobbies = [
            ['hobby'=> 'Reading'],
            ['hobby'=> 'Listening to music'],
        ];
        foreach ($hobbies as $hobby) {
            $user->hobbies()->create($hobby);
        };
        $desired_locations = [
            ['desired_location'=> 'Hồ Chí Minh'],
            ['desired_location'=> 'Cần Thơ'],
        ];
        foreach ($desired_locations as $location) {
            $user->desiredLocations()->create($location);
        };
        $paymentInfo = [
            'bank_name'=> 'Vietcombank',
            'account_name' => 'DANG VAN HIEN',
            'account_number' => '1020229162', 
            'qr_code' => 'storage/image/qrcode/1741657507.jpg'
        ];
        PaymentInfo::create($paymentInfo);
        Footer::create([
            'company'=>'Công ty TNHH JobsWork',
            'bottom' =>
            "Số ĐKKD: [...], cấp ngày [...] do Sở Kế hoạch và Đầu tư Thành phố Hà Nội cấp.
Giấy phép thiết lập Mạng xã hội trên mạng số 568/GP-BTTTT do Bộ Thông tin & Truyền thông cấp ngày [...].
© [...]. All Rights Reserved."
         ]);
    }
}
