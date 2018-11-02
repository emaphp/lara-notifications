import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { AppProvider, Page, Card, ResourceList } from '@shopify/polaris';
import axios from 'axios';
import route from "../../../vendor/tightenco/ziggy/src/js/route";

export default class BreakfastList extends Component {

    constructor(props) {
        super(props);
        this.state  = {
            sortValue: 'DATE_MODIFIED_DESC',
            employeesList: [],
            sortedList: []
        };
        this.handleSortChange = this.handleSortChange.bind(this);
    }

    resourceName = {
        singular: 'customer',
        plural: 'customers',
    };

    sortOptions = [
        {label: 'Order', value: 'DATE_MODIFIED_DESC'},
        {label: 'Breakfasts delegate', value: 'id'},
    ];

    handleSortChange = (sortValue) => {
        const items = this.sortEmployees();
        this.setState({ items, sortValue });
    };

    renderItem = (item) => {
        return (
            <ResourceList.Item id={ item.id }>
                { item.name }
            </ResourceList.Item>);
    };

    sortEmployees = () => {
        const { employeesList, sortValue } = this.state;
        var list = _.orderBy(employeesList, [sortValue], ['asc'])
    };


    componentDidMount() {
        var self = this;
        axios.get(this.props.breakfastListUrl)
            .then(response => {
                self.setState({ employeesList: response.data.list });
            })
            .catch(err => console.log(err));
    }

    render() {
        const {employeesList, sortValue} = this.state;

        return(
            <AppProvider>
                <Page title="The Breakfast Club">
                <Card>
                    <ResourceList
                        resourceName={ this.resourceName }
                        items={ employeesList }
                        renderItem={ this.renderItem } >
                        sortValue={ sortValue }
                        sortOptions={ [
                        {label: 'Order', value: 'DATE_MODIFIED_DESC'},
                    ] }
                        onSortChange={(selected) => {
                            this.setState({sortValue: selected});
                            console.log(`Sort option changed to ${selected}.`);
                        }}
                    </ResourceList>
                </Card>
                </Page>
            </AppProvider>
        )
    }
}


if (document.getElementById('breakfast-club')) {
    ReactDOM.render(<BreakfastList breakfastListUrl={ route('api.theBreakfastClub') } />, document.getElementById('breakfast-club'));
}