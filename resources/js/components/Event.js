import React, { Component } from 'react';
import route from "../../../vendor/tightenco/ziggy/src/js/route";

export default class Event extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return(
            <div data={ this.props.event.id }>
                <p>Name: { this.props.event.name  }</p>
                <p>Star Date: { this.props.event.start_date  } </p>
                <p>Star Time: { this.props.event.start_time } </p>
                <p>End Date: { this.props.event.end_date  } </p>
                <p>End Time { this.props.event.end_time  } </p>
                <p>Place: { this.props.event.place? this.props.event.place.name : 'None' } </p>
                <p>Status: { this.props.event.status }</p>
                <button className="btn btn-link" onClick={ () => { window.location.href = route('events.show', [this.props.event.id]) }}>Go to event</button>
                <p>--------------------------------------</p>
            </div>



        )
    }

}