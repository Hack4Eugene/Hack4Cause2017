import React from 'react';
import {Link} from 'react-router';

export default React.createClass({
    render(){
        return(
            <div>
                <h1>About</h1>
                <Link to="/">Home</Link>
            </div>
        )
    }
});