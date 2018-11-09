import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { AppProvider, Card } from '@shopify/polaris';
import axios from 'axios';
import route from "../../../vendor/tightenco/ziggy/src/js/route";
import Employee from './Employee';

export default class BreakfastList extends Component {

    constructor(props) {
        super(props);
        this.state  = {
            employeesList: []
        };
    }

    componentDidMount() {
        axios.get(route(this.props.employeesCountUrl))
            .then(response => {
                this.setState({
                    employeesList: response.data.employeesList
                });
            })
            .catch(err => console.log(err));
    }


    render() {
        return(
            <AppProvider>
                <Card title="Employees Breakfast List" sectioned>
                {
                    this.state.employeesList.map((user) =>
                    <Employee key = {user.id} user = { user }/>
                )}
                </Card>
            </AppProvider>
        )
    }
}


if (document.getElementById('breakfast-list')) {
    ReactDOM.render(<BreakfastList employeesCountUrl = {'api.breakfastList'} />, document.getElementById('breakfast-list'));
}