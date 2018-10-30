import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { AppProvider, Card, Spinner } from '@shopify/polaris';
import axios from 'axios';
import route from "../../../vendor/tightenco/ziggy/src/js/route";
import Notification from './Notification';

export default class UnreadNotifications extends Component {

    constructor(props) {
        super(props);

        this.state = {
            notifications: [],
            loader: true
        };
    }

    componentDidMount() {
        this.getNotifications();
    }

    render() {
        let data;
        if (this.state.loader) {
            data = <Spinner size="large" color="inkLightest" />
        } else {
            data ="";
        }
        return(
            <AppProvider>
                <Card title="Unread Notifications" sectioned>
                    {data}
                    { this.state.notifications.map((notification) =>
                        <Notification key={notification.id} notification={ notification } clickMethod={ this.markNotificationAsRead } />
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
                self.setState({ loader: false});
            })
            .catch(err => console.log(err));
    }

    markNotificationAsRead = (notificationId, idUser) => {
        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };
        axios.put(route('api.markNotificationAsRead', [notificationId])) //
            .then(response => {
                this.getNotifications();
            })
            .catch(err => console.log(err));
    };
}

if (document.getElementById('unread-notifications')) {
    // var data = document.getElementById('unread-notifications').getAttribute('data');
    var url = route('api.unreadNotifications');
    ReactDOM.render(<UnreadNotifications notificationsUrl={url}/>, document.getElementById('unread-notifications'));
}