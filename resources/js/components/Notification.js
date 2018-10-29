import React, { Component } from 'react';

export default class Notification extends Component {

    constructor(props) {
        super(props);
        this.state = {
            notification: {...props.notification}
        };
    }

    render() {
        return(
            <div data={ this.props.notification.id }>
                { this.props.notification.data.message }
                <button className="btn btn-primary pull-right" onClick={ () => {
                    this.props.clickMethod(this.state.notification.id, this.props.idUser);
                } }>Mark as Read</button>
            </div>
        )
    }

}