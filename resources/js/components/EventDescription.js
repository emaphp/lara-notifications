import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Page, Card, List, AppProvider } from '@shopify/polaris';

export default class EventDescription extends Component {

    constructor(props) {
        super(props);
        this.state  = {
            loading: true,
            event: []
        };
    }

    componentDidMount() {
        axios.get(this.props.eventUrl)
            .then(response => {
                this.setState({
                    event: response.data.event,
                    loading: false
                });
            })
            .catch(err => console.log(err));
    }

    render() {
        if (this.state.event && this.state.event.published_at) {
            return(
                <AppProvider>
                    <Page title="Event">
                        <Card title={ this.state.event.name } sectioned>
                            <p><strong>Description:</strong> <span dangerouslySetInnerHTML={{__html: this.state.event.description}}/></p>
                            <p><strong>Status:</strong> { this.state.event.status }</p>
                            <p><strong>Start Date:</strong> { this.state.event.start_date } - { this.state.event.start_time } hrs</p>
                            <p><strong>End Date:</strong> { this.state.event.end_date } - { this.state.event.end_time } hrs</p>
                            <p>
                                <strong>Guests:</strong>
                                <List type="bullet">
                                    { this.state.event.guests.map((guest) =>
                                        <List.Item>{ guest.name } - { guest.email }</List.Item>
                                    ) }
                                </List>
                            </p>
                        </Card>
                    </Page>
                </AppProvider>
            )
        }
        else {
            return(
                <AppProvider>
                    <Page title="Event">
                        <div className="text-lg-center">
                            <Card title="The event has not been found" sectioned>
                                <img src="https://alasit.com/wp-content/uploads/2018/10/logo-alas.jpg"/>
                            </Card>
                        </div>
                    </Page>
                </AppProvider>
            )
        }

    }
}


if (document.getElementById('event-description')) {
    var slug = document.getElementById('event-description').getAttribute('slug');
    var url = route('api.eventDescription', {slug: slug});
    ReactDOM.render(
        <EventDescription eventUrl={url}/>, document.getElementById('event-description'));
}