import React, { Component } from 'react';
import { AppProvider, Card } from '@shopify/polaris';
import axios from 'axios';
import FilePicker from './FilePicker';

export default class FilePickerComponent extends Component{
    constructor(props){
        super(props);

        this.state = {
            loading: true,
            picture: []
        };
    }

    componentDidMount(){
        axios.get(route(this.props.pictureUrl), { params: { user_id: this.props.userId }})
            .then(response =>{
                this.setState({
                    picture: response.data.profile,
                    loading: false
                });
            })
            .catch(err => console.log(err));
    }

    render(){
        const { loading, picture: profile } = this.state;
        if (loading) {
            return <p>Loading...</p>;
        }

        return(
            <AppProvider>
                <Card title="Profile Picture" sectioned>
                {
                    <FilePicker key = {profile.id} profile = {profile}/>
                }
                </Card>
            </AppProvider>
        )
    }
}