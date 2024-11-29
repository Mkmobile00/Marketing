<?php
namespace App\Data\Customer\SocialLogin;

use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use App\Models\New_Customer;
use App\Enum\Social\SocialEnum;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginData{

    public function googleLogin()
    {
        $agent = new Agent();
        $device = $agent->device();
        $platform = $agent->platform();
        $browser = $agent->browser();
        $desktop = $agent->isDesktop();
        $agent->isRobot();

        $info = [
            'Device'=>$device,
            'Platform'=>$platform,
            'Browser'=>$browser,
            'Desktop'=>$desktop,          
        ];
      
        DB::beginTransaction();
        try{
            $user = Socialite::driver('google')->user();
            $user_exists=New_Customer::whereEmail($user->email)->withTrashed()->first();
            if($user_exists)
            {
                if($user_exists->deleted_at !=null)
                {
                    $user_exists->update([
                        'name'=>$user->name ?? $user_exists->name,
                        'phone'=>$user->phone ?? $user_exists->phone,
                        'photo'=>null,
                        'social_avatar'=>$user['picture']
                    ]);
                    return $user_exists;
                }
            }
            if($user_exists)
            {
                $user_exists->update([
                    'name'=>$user->name,
                    'phone'=>$user->phone,
                    'photo'=>null,
                    'social_avatar'=>$user['picture']
                ]);
                return $user_exists;
            }
            $user=New_Customer::updateOrCreate(
                [
                    'email'=>$user->email
                ],
                [
                    'email'=>$user->email,
                    'name'=>$user->name,
                    'phone'=>$user->phone ?? null,
                    'social_avatar'=>$user['picture'],
                    'email_verified_at'=>Carbon::now(),
                    'password'=>bcrypt($user->id),
                    'data'=>json_encode($info),
                    'social_provider'=>'google',
                    'provider_id' => $user->id,
                    'status' => '1',
                    'photo'=>null,
                ]
            );
            DB::commit();
            return $user;
        }catch(\Throwable $th)
        {
            request()->session()->flash('error',$th->getMessage());
            return redirect()->back();
        }
       
    }

    public function facebookLogin()
    {
        $agent = new Agent();
        $device = $agent->device();
        $platform = $agent->platform();
        $browser = $agent->browser();
        $desktop = $agent->isDesktop();
        $agent->isRobot();

        $info = [
            'Device'=>$device,
            'Platform'=>$platform,
            'Browser'=>$browser,
            'Desktop'=>$desktop,          
        ];
        
        DB::beginTransaction();
        $user = Socialite::driver('facebook')->user();

        $fb_exists=New_Customer::where('fb_id',$user->id)->where('fb_status',1)->first();

        
        if($user->email || $fb_exists)
        {
            $user_exists=New_Customer::whereEmail($user->email)->orWhere('fb_id',$user->id)->first();
            if($user_exists)
            {
                return $data=[
                    'user'=>$user_exists,
                    'if_id'=>false
                ];;
            }
            $user=New_Customer::updateOrCreate(
                [
                    'email'=>$user->email
                ],
                [
                    'email'=>$user->email,
                    'name'=>$user->name,
                    'phone'=>$user->phone ?? null,
                    'social_avatar'=>$user->picture,
                    'email_verified_at'=>Carbon::now(),
                    'password'=>bcrypt($user->id),
                    'data'=>json_encode($info),
                    'social_provider'=>'facebook',
                    'status' => '1',
                    'photo'=>null,
                ]
            );
            DB::commit();
            $data=[
                'user'=>$user,
                'if_id'=>false
            ];

            return $data;
        }
        else
        {
            if(!$user->id)
            {
                request()->session()->flash('error', 'Something Went Wrong');
                return redirect()->route('Clogin');
            }
           
            $userMain=New_Customer::updateOrCreate(
                [
                    'fb_id'=>$user->id
                ],
                [
                    'email'=>$user->id.'@gmail.com',
                    'name'=>$user->name,
                    'phone'=>$user->phone ?? null,
                    'social_avatar'=>$user->avatar,
                    'email_verified_at'=>Carbon::now(),
                    'password'=>bcrypt($user->id),
                    'data'=>null,
                    'social_provider'=>'facebook',
                    'status' => '1',
                    'photo'=>$user->profileUrl ?? null,
                ]
            );
            $facebookData=[
                "id" => $user->id,
                "nickname" =>@$user->nickname,
                "name" => @$user->name,
                "email" =>@$user->email,
                "avatar" => @$user->avatar,
                "avatar_original" => @$user->avatar_original,
                "profileUrl" => @$user->profileUrl,
                'user_id'=>$userMain->id
            ];
            request()->session()->forget('facebookdata');
            request()->session()->put('facebookdata',$facebookData);
            DB::commit();
            $data=[
                'user'=>$user,
                'if_id'=>true
            ];
            return $data;
        }
       
    }

    public function githubLogin()
    {
        $agent = new Agent();
        $device = $agent->device();
        $platform = $agent->platform();
        $browser = $agent->browser();
        $desktop = $agent->isDesktop();
        $agent->isRobot();

        $info = [
            'Device'=>$device,
            'Platform'=>$platform,
            'Browser'=>$browser,
            'Desktop'=>$desktop,          
        ];
        $user = Socialite::driver('github')->user();
        $user_exists=New_Customer::whereEmail($user->email)->first();
        if($user_exists)
        {
            return $user_exists;
        }
        DB::beginTransaction();
        try{
            $user=New_Customer::updateOrCreate(
                [
                    'email'=>$user->email
                ],
                [
                    'email'=>$user->email,
                    'name'=>$user->name ?? $user->nickname,
                    'phone'=>$user->phone ?? null,
                    'social_avatar'=>$user->avatar_url,
                    'email_verified_at'=>Carbon::now(),
                    'password'=>bcrypt($user->id),
                    'data'=>json_encode($info),
                    'socialite'=>SocialEnum::Github,
                    'photo'=>null,
                ]
            );
            DB::commit();
            return $user;

        }catch(\Throwable $th)
        {
            request()->session()->flash('error',$th->getMessage());
            return redirect()->back();
        }
        
        
    }
}