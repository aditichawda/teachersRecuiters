<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Email Verification - TeachersRecruiter</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6fb; padding:30px; margin:0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" style="background:#ffffff; padding:30px; border-radius:8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    
                    <tr>
                        <td align="center" style="padding-bottom: 10px;">
                            <h2 style="color:#1f2937; margin:0;">Email Verification</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 10px 20px;">
                            <p style="color:#374151; font-size:15px;">Hello <strong><?php echo e($user->full_name ?? $user->name ?? 'User'); ?></strong>,</p>

                            <p style="color:#374151; font-size:15px;">
                                Thank you for registering with <strong>TeachersRecruiter</strong>.
                                Please use the verification code below to complete your registration.
                            </p>

                            <div style="text-align:center; margin:30px 0;">
                                <div style="display:inline-block; background:#f0f7ff; border:2px dashed #0073d1; border-radius:8px; padding:16px 32px;">
                                    <span style="
                                        font-size:32px;
                                        letter-spacing:6px;
                                        font-weight:bold;
                                        color:#0073d1;
                                    ">
                                        <?php echo e($verificationCode); ?>

                                    </span>
                                </div>
                            </div>

                            <p style="font-size:14px; color:#6b7280; text-align:center;">
                                This code will expire in <strong>10 minutes</strong>.
                            </p>

                            <p style="font-size:14px; color:#555; margin-top:20px;">
                                If you did not create an account, please ignore this email.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding-top:20px; border-top:1px solid #e5e7eb;">
                            <p style="font-size:12px; color:#999; margin:10px 0 0;">
                                &copy; <?php echo e(date('Y')); ?> TeachersRecruiter. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Aditi\resources\views/emails/verification.blade.php ENDPATH**/ ?>