import React from 'react';
import PeopleCard from './PeopleCard';

class PeopleList extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            people: []
        }
    }

    // render(){
    //     const people ={
    //         id: 1,
    //         name: "Valami",
    //         email: "asd@asd.com",
    //         age: 60,
    //     }
    //     return (
    //         <div className = "row gy-3">
    //             <PeopleCard people={people} />
    //         </div>
    //     )
    // }
    
    componentDidMount() {
        this.getPeople();
    }

    handleTorlesClick = (id) => {
        fetch(`http://localhost/szabo_norbert_people/peoplebackend/api/people/${id}`, {
            method: "DELETE"
        }).then(async response => {
            if (response.status === 204) {
               this.getPeople();
            }
        })
    }

    render() { 
        const {people} = this.state;
        const cardList = [];
        people.forEach(people => {
            cardList.push(<PeopleCard torlesClick={this.handleTorlesClick} key={people.id} people={people} />);
        });

        return (
            <div className="row gy-3">
                {cardList}
            </div>
        );
    }
    
    async getPeople() {
        fetch("http://localhost/szabo_norbert_people/peoplebackend/api/people/")
        .then(response => response.json())
        .then(data => this.setState({
            people: data
        }));
    }
}
export default PeopleList;