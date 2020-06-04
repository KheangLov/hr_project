<template>
    <div class="text-white text-truncate">
        <span class="badge badge-primary" style="padding: 5px; border-radius: 50%; position: absolute; top: -3px; right: 0;">
            {{ unreadNotifications.length }}
        </span>
        <!-- <a class="nav-link dropdown-toggle" href="#" id="userDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @click="markNotificationAsRead">
            <span class="user-name d-block">

            </span>
        </a> -->
        <div class="dropdown-menu dropdown-menu-right custom-dropdown-menu p-0 border-0" aria-labelledby="userDropDown" style="box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.25);">
            <div class="notification-header text-center">
                <h2 class="dropdown-header pt-0 pb-0 font-weight-bold" style="color: #fff;">{{ unreads.length }} unread</h2>
                <h4 class="m-0" style="color: #fff;">All notifications</h4>
            </div>
            <div class="dropdown-divider m-0"></div>
            <!-- <div style="max-height: 290px; overflow-y: auto;">
                <notification-item-component v-for="notification in newNotifications" :notification="notification" :key="notification.id"></notification-item-component>
            </div> -->
        </div>
    </div>
</template>

<script>
    import NotificationItemComponent from './NotificationItemComponent.vue';
    export default {
        props: ['notifications', 'userid', 'unreads'],
        components: { NotificationItemComponent },
        data() {
            return {
                unreadNotifications: this.unreads,
                newNotifications: this.notifications
            }
        },
        methods: {
            markNotificationAsRead() {
                if (this.unreadNotifications.length) {
                    axios.get('/mark-as-read');
                }
            }
        },
        mounted() {
            Echo.private('App.User.' + this.userid)
                .notification((notification) => {
                    let moreNotifications = { data: { messages: notification.email, user_name: notification.name }, id: notification.id };
                    this.newNotifications.unshift(moreNotifications);
                    this.unreadNotifications.unshift(moreNotifications);
                });
        }
    }
</script>
