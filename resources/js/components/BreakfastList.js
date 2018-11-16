import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { AppProvider, Card, ResourceList } from '@shopify/polaris';
import axios from 'axios';
import route from "../../../vendor/tightenco/ziggy/src/js/route";
import Employee from './Employee';

export default class BreakfastList extends Component {

    constructor(props) {
        super(props);
        this.state  = {
            loading: true,
            employeesList: []
        };
    }

    componentDidMount() {
        axios.get(route(this.props.employeesCountUrl))
            .then(response => {
                this.setState({
                    employeesList: response.data.employeesList,
                    loading: false
                });
            })
            .catch(err => console.log(err));
    }

    renderItem = (user) => {
        return (<Employee key={user.id} user={ user }/>)
    };


    render() {
        const resourceName = {singular: 'employees', plural:'employees'};

        return(
            <AppProvider>
                <Card title="Employees Breakfast List" sectioned>
                    {/*<ResourceList*/}
                        {/*resourceName={resourceName}*/}
                        {/*items={this.state.employeesList}*/}
                        {/*renderItem={this.renderItem}*/}
                        {/*loading={this.state.loading}*/}

                    {/*>*/}
                    {/*</ResourceList>*/}
                    <div className="Polaris-ResourceList">
                {
                    this.state.employeesList.map((user) =>
                    <Employee key = {user.id} user = { user }/>
                )}
                    </div>
                </Card>
            </AppProvider>
        )
    }
}


if (document.getElementById('breakfast-list')) {
    ReactDOM.render(<BreakfastList employeesCountUrl = {'api.breakfastList'} />, document.getElementById('breakfast-list'));
}