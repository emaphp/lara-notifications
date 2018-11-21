import React, { Component } from 'react';
import route from "../../../vendor/tightenco/ziggy/src/js/route";

export default class Employee extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        if (this.props.user.postponed) {
            return(
                <div className="border border-danger">
                    <div className="Polaris-ResourceList__ItemWrapper">
                        <div className="employee-card" data={ this.props.user.id }>
                            <p><strong>Name:</strong> { this.props.user.name  }<span className="float-right text-danger">Postponed Breakfast</span></p>
                            <p><strong>E-mail:</strong> {this.props.user.email }</p>
                        </div>
                    </div>
                </div>
            )
        }
        else {
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

}