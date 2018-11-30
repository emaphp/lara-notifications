import React, { Component } from 'react';
import route from "../../../vendor/tightenco/ziggy/src/js/route";

export default class BreakfastHistorial extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return(
            <div className="Polaris-ResourceList__ItemWrapper">
                <div className="employee-card" data={ this.props.user.id }>
                    <p><strong>Fecha:</strong> {this.props.user.date }</p>
                    <p><strong>Name:</strong> { this.props.user.name  }</p>
                </div>
            </div>



        )
    }

}