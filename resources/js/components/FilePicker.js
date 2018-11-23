import React, { Component } from 'react';


export default class FilePicker extends Component {
    constructor(props) {
        super(props);

        this.client = filestack.init('AZOil0qsQZ2VOycAesOhnz');
    }

    handleUpload = result => {
        console.log(arguments[0].profile.id, result.filesUploaded[0].url);

        axios.put(route('api.setFilePicker'), { id: arguments[0].profile.id, url: result.filesUploaded[0].url})
        .then(response =>{
            console.log(response);    
        })
        .catch(err => console.log(err));
     }

    handleClick = () => {
        const options = {
            uploadInBackground: false,
            onUploadDone: this.handleUpload
        };

        this.client.picker(options).open();
    }

    render() {
        return(
            <div className="Polaris-ResourceList__ItemWrapper">
                <div className="employee-card" data={ this.props.profile.id }>
                    <p>FOTO: {this.props.profile.picture } </p> 
                </div>
                <div>
                    <button onClick={this.handleClick}>Click!</button>
                </div>
            </div>
        )
    }
}