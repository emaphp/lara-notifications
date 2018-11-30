import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { AppProvider, Card } from '@shopify/polaris';
import axios from 'axios';

export default class EmployeesQuantity extends Component {

    constructor(props) {
        super(props);
        this.state  = {
            quantity: 0
        };
    }

    componentDidMount() {
        var self = this;
        axios.get(route(this.props.employeesCountUrl))
            .then(response => {
                self.setState({ quantity: response.data.quantity });
            })
            .catch(err => console.log(err));
    }


    render() {
        return(
            <AppProvider>
                <Card title="Employees" sectioned>
                    <p>Total employees: { this.state.quantity }</p>
                </Card>
            </AppProvider>
        )
    }
}


if (document.getElementById('employees-quantity')) {
    ReactDOM.render(<EmployeesQuantity employeesCountUrl={'api.employeesQuantity'}/>, document.getElementById('employees-quantity'));
}