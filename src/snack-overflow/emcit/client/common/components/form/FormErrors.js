import React from 'react'

import classes from './FormErrors.css'

export default ({ errors }) => {
    if (!errors || errors.length === 0) {
        return null;
    }
    return (
        <div className={classes.errors}>
            {errors.map(error => <div className={classes.error}>{error}</div>)}
        </div>
    )
}
