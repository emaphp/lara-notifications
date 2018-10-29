import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { AppProvider, Card } from '@shopify/polaris';
import axios from 'axios';
import route from "../../../vendor/tightenco/ziggy/src/js/route";
import Notification from './Notification';

export default class UnreadNotifications extends Component {

    constructor(props) {
        super(props);

        this.state = {
            notifications: []
        };
    }

    componentDidMount() {
        this.getNotifications();
    }

    render() {
        return(
            <AppProvider>
                <Card title="Unread Notifications" sectioned>
                    { this.state.notifications.map((notification) =>
                        <Notification key={notification.id} notification={ notification } idUser={this.props.idUser} clickMethod={ this.markNotificationAsRead } />
                    ) }
                </Card>
            </AppProvider>
        )
    }

    getNotifications() {
        var self = this;
        axios.get(this.props.notificationsUrl)
            .then(response => {
                self.setState({ notifications: response.data.notifications });
            })
            .catch(err => console.log(err));
    }

    markNotificationAsRead = (notificationId, idUser) => {
        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };
        axios.put(route('api.markNotificationAsRead', [notificationId, idUser])) //
            .then(response => {
                this.getNotifications();
            })
            .catch(err => console.log(err));
    };
}

if (document.getElementById('unread-notifications')) {
    var data = document.getElementById('unread-notifications').getAttribute('data');
    var url = route('api.unreadNotifications', {id: data});
    ReactDOM.render(<UnreadNotifications notificationsUrl={url} idUser={data}/>, document.getElementById('unread-notifications'));
}