import React, { Component } from 'react';
import route from "../../../vendor/tightenco/ziggy/src/js/route";

export default class Employee extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return(
            <div className="Polaris-ResourceList__ItemWrapper">
            <div className="employee-card" data={ this.props.user.id }>
                <p><strong>Name:</strong> { this.props.user.name  }</p>
                <p><strong>E-mail:</strong> {this.props.user.email }</p>
            </div>
            </div>
        )
    }

}