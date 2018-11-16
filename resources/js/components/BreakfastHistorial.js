import React, { Component } from 'react';
import route from "../../../vendor/tightenco/ziggy/src/js/route";

export default class BreakfastHistorial extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return(
            <div className="border border-primary" data={ this.props.user.id }>
            <br></br>
                <p><strong>Fecha:</strong> {this.props.user.date }</p>
                <p><strong>Name:</strong> { this.props.user.name  }</p>
            <br></br>
            </div>



        )
    }

}