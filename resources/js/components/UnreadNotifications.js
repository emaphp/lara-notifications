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
        var self = this;
        axios.get(this.props.notificationsUrl)
            .then(response => {
                self.setState({ notifications: response.data.notifications });
            })
            .catch(err => console.log(err));
    }


    render() {
        return(
            <AppProvider>
                <Card title="Unread Notifications" sectioned>
                    { this.state.notifications.map((notification) =>
                        <Notification key={notification.id} notification={ notification } />
                    ) }
                </Card>
            </AppProvider>
        )
    }
}

if (document.getElementById('unread-notifications')) {
    var data = document.getElementById('unread-notifications').getAttribute('data');
    var url = route('api.unreadNotifications', {id: data});
    ReactDOM.render(<UnreadNotifications notificationsUrl={url}/>, document.getElementById('unread-notifications'));
}