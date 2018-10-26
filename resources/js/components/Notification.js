import React, { Component } from 'react';

export default class Notification extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return(
            <div data={ this.props.notification.id }>
                { this.props.notification.data.message }
            </div>
        )
    }

}