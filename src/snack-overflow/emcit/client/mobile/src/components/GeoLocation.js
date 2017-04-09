import React from 'react'
import PlacesAutocomplete, {geocodeByAddress} from 'react-places-autocomplete'
import muiClasses from 'react-toolbox/lib/input/theme.css';
import classes from './GeoLocation.css';

class GeoLocation extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            lat: '',
            lng: '',
            address: '',
            error: null,
            loading: false
        }
        this.handleSelect = this.handleSelect.bind(this)
        this.handleChange = this.handleChange.bind(this)
    }

    updateState(state){
        this.setState(state, () => {this.props.onUpdate(this.state)})
    }

    handleSelect(address) {
        this.setState({address, loading: true})

        geocodeByAddress(address, (error, {lat, lng}) => {
            const loading = false;
            if (error) {
                this.updateState({error, loading})
            } else {
                this.updateState({error, loading, lat, lng})
            }
        })
    }

    handleChange(address) {
        this.setState({
            address,
            error: null
        })
    }

    render() {

        const cssClasses = {
            classes: muiClasses.input,
            input: muiClasses.inputElement,
            autocompleteContainer: classes.autocompleteContainer,
        }

        const AutocompleteItem = ({formattedSuggestion}) => (
            <div>
                {/* add map pin icon here */}
                <strong>{formattedSuggestion.mainText}</strong>
                {' '} {/*  space between main text and muted text  */}
                <small className="text-muted">{formattedSuggestion.secondaryText}</small>
            </div>)

        return (
            <div className='page-wrapper' style={{marginTop: 40}}>
                <div className='container'>
                    <PlacesAutocomplete
                        value={this.state.address}
                        onChange={this.handleChange}
                        onSelect={this.handleSelect}
                        autocompleteItem={AutocompleteItem}
                        autoFocus={true}
                        placeholder={this.props.placeholder}
                        hideLabel={true}
                        inputName="Demo__input"
                        onEnterKeyDown={this.handleSelect}
                        classNames={cssClasses}
                    />
                    {this.state.loading ? <div>loading</div> : null}
                    {!this.state.loading && this.state.error}
                </div>
            </div>
        )
    }
}

export default GeoLocation
