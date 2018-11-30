import React, { Component } from 'react';
import route from "../../../vendor/tightenco/ziggy/src/js/route";

export default class Event extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return(
            <div className="Polaris-ResourceList__ItemWrapper">
                <div className="employee-card" data={ this.props.event.id }>
                    <p><strong>Name:</strong> { this.props.event.name  }</p>
                    <p><strong>Star Date:</strong> { this.props.event.start_date  } </p>
                    <p><strong>Star Time:</strong> { this.props.event.start_time } </p>
                    <p><strong>End Date:</strong> { this.props.event.end_date  } </p>
                    <p><strong>End Time:</strong> { this.props.event.end_time  } </p>
                    <p><strong>Place:</strong> { this.props.event.place? this.props.event.place.name : 'None' } </p>
                    <p><strong>Status:</strong> { this.props.event.status }</p>
                    <button className="btn btn-link" onClick={ () => { window.location.href = route('events.show', [this.props.event.id]) }}>Go to event</button>
                    
                </div>
            </div>



        )
    }

}