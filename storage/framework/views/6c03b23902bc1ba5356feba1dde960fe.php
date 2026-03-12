<?php
    Theme::set('header_css_class', '');
    Theme::set('withPageHeader', false);
    Theme::set('bodyClass', 'hide-page-banner notifications-page');
    
    // Dynamic notifications from database
    $notifications = $notifications ?? collect([]);
    $unreadCount = $unreadCount ?? 0;
    $readCount = $readCount ?? 0;
    $totalCount = $notifications->count();
?>

<style>
.notifications-section {
    padding: 100px 0 60px;
    background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 50%, #f0f9ff 100%);
    min-height: 85vh;
    position: relative;
    overflow: hidden;
}
.notifications-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(25, 103, 210, 0.08) 0%, transparent 70%);
    border-radius: 50%;
    animation: float 20s ease-in-out infinite;
}
.notifications-section::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(99, 102, 241, 0.06) 0%, transparent 70%);
    border-radius: 50%;
    animation: float 25s ease-in-out infinite reverse;
}
.notifications-header {
    text-align: center;
    margin-bottom: 50px;
    position: relative;
    z-index: 1;
}
.notifications-header h1 {
    font-size: 48px;
    font-weight: 900;
    background: linear-gradient(135deg, #1967d2 0%, #6366f1 50%, #8b5cf6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 16px;
    letter-spacing: -1px;
    text-shadow: 0 2px 20px rgba(25, 103, 210, 0.1);
    animation: fadeInDown 0.6s ease-out;
}
.notifications-header p {
    font-size: 19px;
    color: #64748b;
    font-weight: 500;
    animation: fadeInUp 0.6s ease-out 0.2s both;
}
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.notifications-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 1;
}
.notifications-tabs {
    display: flex;
    gap: 16px;
    margin-bottom: 35px;
    justify-content: center;
    flex-wrap: wrap;
    animation: fadeInUp 0.6s ease-out 0.4s both;
}
.notification-tab {
    padding: 14px 32px;
    border: 2px solid #e2e8f0;
    background: #fff;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 700;
    color: #64748b;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}
.notification-tab::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(25, 103, 210, 0.12);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}
.notification-tab:hover::before {
    width: 400px;
    height: 400px;
}
.notification-tab:hover {
    border-color: #1967d2;
    color: #1967d2;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(25, 103, 210, 0.2);
}
.notification-tab.active {
    background: linear-gradient(135deg, #1967d2 0%, #6366f1 100%);
    border-color: transparent;
    color: #fff;
    box-shadow: 0 8px 25px rgba(25, 103, 210, 0.35);
    transform: translateY(-3px);
}
.notification-tab.active::before {
    background: rgba(255, 255, 255, 0.2);
}
.notification-tab .badge {
    margin-left: 10px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 800;
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(10px);
    min-width: 24px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.notification-tab.active .badge {
    background: rgba(255, 255, 255, 0.35);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}
.notifications-list {
    background: transparent;
    border-radius: 0;
    box-shadow: none;
    overflow: visible;
    border: none;
    animation: fadeInUp 0.6s ease-out 0.6s both;
    backdrop-filter: none;
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.notification-item {
    display: flex;
    align-items: flex-start;
    padding: 24px 28px;
    border: 2px solid #e2e8f0;
    border-radius: 16px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: default;
    position: relative;
    animation: slideIn 0.4s ease-out;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
}
.notification-item:nth-child(1) { animation-delay: 0.1s; }
.notification-item:nth-child(2) { animation-delay: 0.15s; }
.notification-item:nth-child(3) { animation-delay: 0.2s; }
.notification-item:nth-child(4) { animation-delay: 0.25s; }
.notification-item:nth-child(5) { animation-delay: 0.3s; }
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateX(0) scale(1);
    }
}
.notification-item:hover {
    background: linear-gradient(90deg, #f8fafc 0%, #f0f9ff 100%);
    transform: translateY(-2px) scale(1.01);
    box-shadow: 0 8px 24px rgba(25, 103, 210, 0.12);
    border-color: #cbd5e1;
}
.notification-item.unread {
    background: linear-gradient(90deg, #f0f9ff 0%, #e0f2fe 100%);
    border: 2px solid #bfdbfe;
    position: relative;
    box-shadow: 0 4px 16px rgba(25, 103, 210, 0.1);
}
.notification-item.unread::after {
    content: '';
    position: absolute;
    right: 20px;
    top: 20px;
    width: 10px;
    height: 10px;
    background: #1967d2;
    border-radius: 50%;
    box-shadow: 0 0 0 3px rgba(25, 103, 210, 0.2);
    animation: ping 2s infinite;
}
@keyframes ping {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    75%, 100% {
        transform: scale(1.5);
        opacity: 0;
    }
}
.notification-icon {
    width: 64px;
    height: 64px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: #fff;
    margin-right: 20px;
    flex-shrink: 0;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(0, 0, 0, 0.05);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, var(--icon-color, #1967d2) 0%, var(--icon-color-dark, #6366f1) 100%);
}
.notification-icon::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transform: rotate(45deg);
    transition: all 0.6s;
}
.notification-item:hover .notification-icon::before {
    animation: shine 2s infinite;
}
@keyframes shine {
    0% {
        transform: translateX(-100%) translateY(-100%) rotate(45deg);
    }
    100% {
        transform: translateX(100%) translateY(100%) rotate(45deg);
    }
}
.notification-item:hover .notification-icon {
    transform: scale(1.15) rotate(8deg);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(0, 0, 0, 0.1);
}
.notification-content {
    flex: 1;
    min-width: 0;
    padding-right: 10px;
}
.notification-title {
    font-size: 18px;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 10px;
    line-height: 1.5;
    word-wrap: break-word;
    letter-spacing: -0.3px;
}
.notification-item.unread .notification-title {
    font-weight: 900;
    color: #0f172a;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
}
.notification-message {
    font-size: 15px;
    color: #475569;
    line-height: 1.7;
    margin-bottom: 12px;
    word-wrap: break-word;
    font-weight: 500;
}
.notification-item.unread .notification-message {
    color: #334155;
    font-weight: 600;
}
.notification-time {
    font-size: 13px;
    color: #94a3b8;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.notification-time::before {
    content: '🕐';
    font-size: 14px;
    filter: grayscale(0.3);
}
.notification-actions {
    display: flex;
    gap: 10px;
    margin-left: 15px;
    opacity: 0;
    transition: opacity 0.4s ease, transform 0.4s ease;
    transform: translateX(10px);
}
.notification-item:hover .notification-actions {
    opacity: 1;
    transform: translateX(0);
}
.notification-action-btn {
    padding: 10px 16px;
    border-radius: 12px;
    border: 2px solid #e2e8f0;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    color: #64748b;
    font-size: 16px;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    white-space: nowrap;
    min-width: auto;
    height: 44px;
}
.notification-action-btn i {
    font-size: 18px;
    flex-shrink: 0;
}
.notification-action-btn .action-text {
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.3px;
}
.notification-action-btn:hover {
    background: linear-gradient(135deg, #1967d2 0%, #6366f1 100%);
    border-color: transparent;
    color: #fff;
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(25, 103, 210, 0.4);
}
.notification-action-btn:hover .action-text {
    color: #fff;
}
.notification-action-btn.delete-btn:hover {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
}
.empty-notifications {
    text-align: center;
    padding: 100px 20px;
    color: #94a3b8;
}
.empty-notifications i {
    font-size: 100px;
    margin-bottom: 30px;
    opacity: 0.3;
    animation: float 4s ease-in-out infinite;
    background: linear-gradient(135deg, #1967d2, #6366f1);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
@keyframes float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-15px) rotate(5deg);
    }
}
.empty-notifications h3 {
    font-size: 28px;
    font-weight: 800;
    color: #475569;
    margin-bottom: 16px;
    letter-spacing: -0.5px;
}
.empty-notifications p {
    font-size: 17px;
    color: #94a3b8;
    max-width: 450px;
    margin: 0 auto;
    line-height: 1.7;
    font-weight: 500;
}
@media(max-width: 768px) {
    .notifications-section { 
        padding: 80px 0 40px; 
    }
    .notifications-container { 
        padding: 0 15px; 
    }
    .notifications-header { 
        margin-bottom: 35px; 
    }
    .notifications-header h1 { 
        font-size: 36px; 
    }
    .notifications-header p { 
        font-size: 17px; 
    }
    .notifications-tabs { 
        gap: 10px; 
        margin-bottom: 25px; 
    }
    .notification-tab { 
        padding: 12px 24px; 
        font-size: 14px; 
    }
    .notification-item { 
        padding: 20px 18px; 
    }
    .notification-icon { 
        width: 56px; 
        height: 56px; 
        font-size: 24px; 
        margin-right: 16px; 
    }
    .notification-title { 
        font-size: 17px; 
    }
    .notification-message { 
        font-size: 14px; 
    }
    .notification-actions { 
        opacity: 1; 
        transform: translateX(0);
    }
    .notification-action-btn {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
}
</style>

<section class="notifications-section">
    <div class="container">
        <div class="notifications-header">
            <h1><?php echo e(__('Notifications')); ?></h1>
            <p><?php echo e(__('Stay updated with your job applications and opportunities')); ?></p>
        </div>

        <div class="notifications-container">
            <div class="notifications-tabs">
                <button class="notification-tab active" data-filter="all">
                    <?php echo e(__('All')); ?> <span class="badge"><?php echo e($totalCount); ?></span>
                </button>
                <button class="notification-tab" data-filter="unread">
                    <?php echo e(__('Unread')); ?> <span class="badge"><?php echo e($unreadCount); ?></span>
                </button>
                <button class="notification-tab" data-filter="read">
                    <?php echo e(__('Read')); ?> <span class="badge"><?php echo e($readCount); ?></span>
                </button>
            </div>

            <div class="notifications-list">
                <?php if(count($notifications) > 0): ?>
                    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="notification-item <?php echo e(!$notification['read'] ? 'unread' : ''); ?>" 
                             data-type="<?php echo e($notification['type']); ?>"
                             data-read="<?php echo e($notification['read'] ? 'true' : 'false'); ?>"
                             data-id="<?php echo e($notification['id']); ?>">
                            <div class="notification-icon" 
                                 style="background: linear-gradient(135deg, <?php echo e($notification['color']); ?> 0%, <?php echo e($notification['color']); ?>dd 100%); 
                                        --icon-color: <?php echo e($notification['color']); ?>;
                                        --icon-color-dark: <?php echo e($notification['color']); ?>dd;
                                        box-shadow: 0 8px 20px <?php echo e($notification['color']); ?>40;">
                                <i class="<?php echo e($notification['icon']); ?>"></i>
                            </div>
                            <div class="notification-content">
                                <div class="notification-title"><?php echo e($notification['title']); ?></div>
                                <div class="notification-message"><?php echo e($notification['message']); ?></div>
                                <div class="notification-time"><?php echo e($notification['time']); ?></div>
                            </div>
                            <div class="notification-actions">
                                <?php if(!$notification['read']): ?>
                                    <button class="notification-action-btn mark-read-btn" 
                                            data-id="<?php echo e($notification['id']); ?>"
                                            title="<?php echo e(__('Mark as read')); ?>">
                                        <i class="feather-check"></i>
                                        <span class="action-text"><?php echo e(__('Mark as Read')); ?></span>
                                    </button>
                                <?php endif; ?>
                                <button class="notification-action-btn delete-btn" 
                                        data-id="<?php echo e($notification['id']); ?>"
                                        title="<?php echo e(__('Delete')); ?>">
                                    <i class="feather-trash-2"></i>
                                    <span class="action-text"><?php echo e(__('Delete')); ?></span>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="empty-notifications">
                        <i class="feather-bell-off"></i>
                        <h3><?php echo e(__('No notifications')); ?></h3>
                        <p><?php echo e(__('You are all caught up! New notifications will appear here.')); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab filtering
    document.querySelectorAll('.notification-tab').forEach(function(tab) {
        tab.addEventListener('click', function() {
            // Update active tab
            document.querySelectorAll('.notification-tab').forEach(function(t) {
                t.classList.remove('active');
            });
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');
            const items = document.querySelectorAll('.notification-item');

            items.forEach(function(item) {
                if (filter === 'all') {
                    item.style.display = 'flex';
                } else if (filter === 'unread') {
                    item.style.display = item.classList.contains('unread') ? 'flex' : 'none';
                } else if (filter === 'read') {
                    item.style.display = item.classList.contains('unread') ? 'none' : 'flex';
                }
            });
        });
    });

    // Mark as read
    document.querySelectorAll('.mark-read-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            const notificationId = this.getAttribute('data-id');
            const item = this.closest('.notification-item');
            
            fetch('<?php echo e(route("public.account.notifications.read", ":id")); ?>'.replace(':id', notificationId), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.message || 'Error marking notification as read');
                    return;
                }
                item.classList.remove('unread');
                item.style.background = '#fff';
                item.style.borderLeft = 'none';
                item.setAttribute('data-read', 'true');
                this.remove();
                
                // Update badge counts
                updateBadgeCounts();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error marking notification as read');
            });
        });
    });

                // Delete notification
    document.querySelectorAll('.delete-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            const notificationId = this.getAttribute('data-id');
            const item = this.closest('.notification-item');
            
            if (!confirm('<?php echo e(__('Are you sure you want to delete this notification?')); ?>')) {
                return;
            }
            
            fetch('<?php echo e(route("public.account.notifications.delete", ":id")); ?>'.replace(':id', notificationId), {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.message || 'Error deleting notification');
                    return;
                }
                    item.style.transition = 'opacity 0.3s';
                    item.style.opacity = '0';
                    setTimeout(function() {
                        item.remove();
                    updateBadgeCounts();
                    }, 300);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting notification');
            });
        });
    });

    // Update badge counts
    function updateBadgeCounts() {
        const items = document.querySelectorAll('.notification-item');
        const unreadItems = document.querySelectorAll('.notification-item.unread');
        const readItems = document.querySelectorAll('.notification-item:not(.unread)');
        
        document.querySelector('[data-filter="all"] .badge').textContent = items.length;
        document.querySelector('[data-filter="unread"] .badge').textContent = unreadItems.length;
        document.querySelector('[data-filter="read"] .badge').textContent = readItems.length;
    }
});
</script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/notifications.blade.php ENDPATH**/ ?>