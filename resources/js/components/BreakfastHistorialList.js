import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { AppProvider, Card } from '@shopify/polaris';
import axios from 'axios';
import route from "../../../vendor/tightenco/ziggy/src/js/route";
import BreakfastHistorial from './BreakfastHistorial';

export default class BreakfastHistorialList extends Component {

    constructor(props) {
        super(props);
        this.state  = {
            employeesHistorialList: []
        };
    }

    componentDidMount() {
        axios.get(route(this.props.employeesCountUrl))
            .then(response => {
                this.setState({
                    employeesHistorialList: response.data.employeesHistorialList
                });
            })
            .catch(err => console.log(err));
    }


    render() {
        return(
            <AppProvider>
                <Card title="Employees Breakfast Historial List" sectioned>
                {
                    this.state.employeesHistorialList.map((user) =>
                    <BreakfastHistorial key = {user.id} user = { user }/>
                )}
                </Card>
            </AppProvider>
        )
    }
}


if (document.getElementById('breakfast-historial')) {
    ReactDOM.render(<BreakfastHistorialList employeesCountUrl = {'api.breakfastHistorial'} />, document.getElementById('breakfast-historial'));
}