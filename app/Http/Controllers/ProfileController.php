<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function profile(){
        return view('profile.edit_name_image');
    }

    public function otp(){
        $page = session('otpPage');
        return view('profile.profile_otp',compact('page'));
    }

    public function changeMailPage(){
        return view('profile.edit_mail');
    }

    public function changePasswordPage(){
        return view ('profile.change_password');
    }

    public function updateName(Request $request, $id){
        $now = \Carbon\Carbon::now('Asia/Jakarta');
        $update = [
            'name' => $request->input('nama_pengguna'),
            'updated_at' => $now
        ];
        $insertUpdate = User::whereId($id)->update($update);

        if ($insertUpdate){
            return redirect()->route('profile.edit')->with([
                'message' => 'Berhasil memperbarui profil.',
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->route('profile.edit')->with([
                'message' => 'Tidak dapat memperbarui profil. ',
                'alert-type' => 'error'
            ]);
        }

    }

    public function sendToOldMail($id){
        $email = User::find($id)->email;
        $mail = new PHPMailer(true);
        $randomNumber = "";
        for ($i = 0; $i < 6; $i++) {
            $randomNumber .= mt_rand(0, 9); // generates a random digit (0-9)
        }
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                           // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';    // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                  // Enable SMTP authentication
            $mail->Username   =  getenv('EMAIL'); // SMTP username
            $mail->Password   =  getenv('PASSWORD');       // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                   // TCP port to connect to
        
            //Recipients
            $mail->setFrom(getenv('EMAIL'), "Don't Replay");
            $mail->addAddress($email); // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Verification Code';
            $mail->Body    = 'Your verification code is '.$randomNumber;

        
            $mail->send();
            session(['otp' => $randomNumber]);
            session(['otpPage' => 1]);

            return redirect()->route('profile.otp');
        }catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return redirect()->route('profile.edit')->with([
                'message' => 'Tidak dapat mengirim email. ',
                'alert-type' => 'error'
            ]);
        }
    }

    public function sendToNewMail(Request $request){
        $email = $request->input('email');
        $mail = new PHPMailer(true);
        $randomNumber = "";
        for ($i = 0; $i < 6; $i++) {
            $randomNumber .= mt_rand(0, 9); // generates a random digit (0-9)
        }
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                           // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';    // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                  // Enable SMTP authentication
            $mail->Username   =  getenv('EMAIL'); // SMTP username
            $mail->Password   =  getenv('PASSWORD');       // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                   // TCP port to connect to
        
            //Recipients
            $mail->setFrom(getenv('EMAIL'), "Don't Replay");
            $mail->addAddress($email); // Add a recipient
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Verification Code';
            $mail->Body    = 'Your verification code is '.$randomNumber;

        
            $mail->send();
            session(['otp' => $randomNumber]);
            session(['otpPage' => 2]);
            session(['newMail' => $email]);

            return redirect()->route('profile.otp');
        }catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return redirect()->route('profile.edit')->with([
                'message' => 'Tidak dapat mengirim email. ',
                'alert-type' => 'error'
            ]);
        }
    }

    public function sendResetPassword($id){
        $email = User::find($id)->email;
        $mail = new PHPMailer(true);
        $randomNumber = "";
        for ($i = 0; $i < 6; $i++) {
            $randomNumber .= mt_rand(0, 9); // generates a random digit (0-9)
        }
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                           // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';    // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                  // Enable SMTP authentication
            $mail->Username   = getenv('EMAIL'); // SMTP username
            $mail->Password   = getenv('PASSWORD');      // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                   // TCP port to connect to
        
            //Recipients
            $mail->setFrom(getenv('EMAIL'), "Don't Replay");
            $mail->addAddress($email); // Add a recipient
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Verification Code';
            $mail->Body    = 'Your verification code is '.$randomNumber;

        
            $mail->send();
            session(['otp' => $randomNumber]);
            session(['otpPage' => 3]);

            return redirect()->route('profile.otp');
        }catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                return redirect()->route('profile.edit')->with([
                    'message' => 'Tidak dapat mengirim email. ',
                    'alert-type' => 'error'
                ]);
        }
    }

    public function verifyOtp(Request $request, $id){
        $page = session('otpPage');
        $savedOtp = session('otp');
        if ($page == 1){
                if ($request->input('otp') == $savedOtp){
                    return redirect()->route('profile.changeMailPage');
                } else {
                    session(['otpPage' => 1]);
                    return redirect()->route('profile.otp')->with([
                        'message' => 'Kode OTP salah.',
                        'alert-type' => 'error'
                    ]);
                } 
            } else if ($page == 2){
                if ($request->input('otp') == $savedOtp){
                    $now = \Carbon\Carbon::now('Asia/Jakarta');
                    $update = [
                        'email' => session('newMail'),
                        'updated_at' => $now
                    ];
                    $insertUpdate = User::whereId($id)->update($update);
                
                    if ($insertUpdate){
                        return redirect()->route('profile.edit')->with([
                            'message' => 'Berhasil memperbarui email.',
                            'alert-type' => 'success'
                        ]);
                    } else {
                        return redirect()->route('profile.edit')->with([
                            'message' => 'Tidak dapat memperbarui email. ',
                            'alert-type' => 'error'
                        ]);
                    }
                } else {
                    $page = 2;
                    return redirect()->route('profile.otp',compact('page'))->with([
                        'message' => 'kode OTP salah.',
                        'alert-type' => 'error'
                    ]);
                } 
        } else if ($page == 3){
            if ($request->input('otp') == $savedOtp){
                return redirect()->route('profile.changePasswordPage');
            } else {
                session(['otpPage' => 3]);
                return redirect()->route('profile.otp')->with([
                    'message' => 'Kode OTP salah.',
                    'alert-type' => 'error'
                ]);
            } 
        }
    }

    public function changePassword(Request $request,$id){
        $now = \Carbon\Carbon::now('Asia/Jakarta');
        $new_password =$request->input('password');
        $update = [
            'password' => Hash::make($new_password),
            'updated_at' => $now
        ];
        $insertUpdate = User::whereId($id)->update($update);
        if ($insertUpdate){
            return redirect()->route('profile.edit')->with([
                'message' => 'Berhasil memperbarui password.',
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->route('profile.edit')->with([
                'message' => 'Tidak dapat memperbarui password. ',
                'alert-type' => 'error'
            ]);
        }
    }

    public function changePicture(Request $request, $id){
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('profile.edit')->with([
                'message' => 'User tidak ditemukan.',
                'alert-type' => 'error'
            ]);
        }
    
        $now = \Carbon\Carbon::now('Asia/Jakarta');
        $newPicture = $request->file('profilePicture');
    
        // Generate nama unik untuk file gambar baru berdasarkan timestamp
        $originalName = $newPicture->getClientOriginalName();
        $extension = $newPicture->getClientOriginalExtension();
        $filename = pathinfo($originalName, PATHINFO_FILENAME);
    
        // Bersihkan nama file dari simbol-simbol khusus
        $cleanedFileName = Str::slug($filename) . '_' . time() . '.' . $extension;
    
        $destinationPath = 'profileImage/';
        $image_path = $destinationPath . $cleanedFileName;
    
        // Hapus file lama jika ada
        $oldImagePath = $user->image_path;
        if ($oldImagePath && File::exists(public_path($oldImagePath))) {
            File::delete(public_path($oldImagePath));
        }
    
        // Update database dengan path gambar baru
        $update = [
            'image_path' => $image_path,
            'updated_at' => $now
        ];
    
        $insertUpdate = User::whereId($id)->update($update);
    
        // Pindahkan file baru ke direktori tujuan
        $newPicture->move(public_path($destinationPath), $cleanedFileName);
    
        if ($insertUpdate){
            return redirect()->route('profile.edit')->with([
                'message' => 'Berhasil memperbarui profil.',
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->route('profile.edit')->with([
                'message' => 'Tidak dapat memperbarui profil. ',
                'alert-type' => 'error'
            ]);
        }
    }
    
}
