import React, { Component } from 'react';
import route from "../../../vendor/tightenco/ziggy/src/js/route";

export default class Employee extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return(
            <div className="border border-primary" data={ this.props.user.id }>
            <br></br>
                <p><strong>Name:</strong> { this.props.user.name  }</p>
                <p><strong>E-mail:</strong> {this.props.user.email }</p>
            <br></br>
            </div>



        )
    }

}