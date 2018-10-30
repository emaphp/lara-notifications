import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { AppProvider, Card } from '@shopify/polaris';
import axios from 'axios';
import route from "../../../vendor/tightenco/ziggy/src/js/route";
import Event from './Event';


export default class PendingEvents extends Component {

    constructor(props) {
        super(props);
        this.state  = {
            eventList: []
        };
    }

    componentDidMount() {
        var self = this;
        var url = route(this.props.eventListUrlName, { year: today.getFullYear(), month: today.getMonth()+1 });
        axios.get(url)
            .then(response => {
                self.setState({ eventList: response.data.eventList });
            })
            .catch(err => console.log(err));
    }


    render() {
        return(
            <AppProvider>
                <Card title="Pending Events" sectioned>
                    { this.state.eventList.map((event) =>
                        <Event key = {event.id} event = { event } />
                    )}
                </Card>
            </AppProvider>
        )
    }
}


if (document.getElementById('pending-events')) {
    var today = new Date();
    ReactDOM.render(<PendingEvents eventListUrlName={ 'api.pendingEvents' } month={ today.getMonth()+1 } year={ today.getFullYear() } />, document.getElementById('pending-events'));
}