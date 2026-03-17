<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo e($notification->title); ?> - TeachersRecruiter</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6fb; padding:30px; margin:0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" style="background:#ffffff; padding:30px; border-radius:8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    
                    <tr>
                        <td align="center" style="padding-bottom: 20px;">
                            <div style="width: 60px; height: 60px; background: <?php echo e($notification->color); ?>; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                                <span style="font-size: 28px; color: #ffffff;">🔔</span>
                            </div>
                            <h2 style="color:#1f2937; margin:0; font-size: 24px;"><?php echo e($notification->title); ?></h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 10px 20px;">
                            <p style="color:#374151; font-size:15px; line-height: 1.6;">Hello <strong><?php echo e($account->full_name ?? $account->name ?? 'User'); ?></strong>,</p>

                            <div style="background:#f9fafb; border-left: 4px solid <?php echo e($notification->color); ?>; padding: 15px 20px; margin: 20px 0; border-radius: 4px;">
                                <p style="color:#374151; font-size:15px; line-height: 1.6; margin: 0;">
                                    <?php echo e($notification->message); ?>

                                </p>
                            </div>

                            <?php if($notification->action_url): ?>
                            <div style="text-align:center; margin:30px 0;">
                                <a href="<?php echo e(url($notification->action_url)); ?>" 
                                   style="display:inline-block; background:<?php echo e($notification->color); ?>; color:#ffffff; padding:12px 30px; text-decoration:none; border-radius:6px; font-weight:600; font-size:15px;">
                                    View Details
                                </a>
                            </div>
                            <?php endif; ?>

                            <p style="font-size:14px; color:#6b7280; margin-top:20px;">
                                This is an automated notification from TeachersRecruiter. 
                                <?php if($notification->action_url): ?>
                                You can view more details by clicking the button above or 
                                <a href="<?php echo e(url($notification->action_url)); ?>" style="color:<?php echo e($notification->color); ?>;">clicking here</a>.
                                <?php endif; ?>
                            </p>

                            <p style="font-size:14px; color:#555; margin-top:20px; padding-top:20px; border-top:1px solid #e5e7eb;">
                                <strong>Notification Type:</strong> <?php echo e(ucwords(str_replace('_', ' ', $notification->type))); ?><br>
                                <strong>Date:</strong> <?php echo e($notification->created_at->format('F d, Y h:i A')); ?>

                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding-top:20px; border-top:1px solid #e5e7eb;">
                            <p style="font-size:12px; color:#999; margin:10px 0 0;">
                                &copy; <?php echo e(date('Y')); ?> TeachersRecruiter. All rights reserved.
                            </p>
                            <p style="font-size:12px; color:#999; margin:5px 0 0;">
                                You are receiving this email because you have an account with TeachersRecruiter.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/plugins/job-board/resources/views/emails/user-notification.blade.php ENDPATH**/ ?>