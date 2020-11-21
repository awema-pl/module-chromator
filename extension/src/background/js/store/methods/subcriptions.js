import moment from 'moment';

export function getExpiresAt(state) {
    let expiresAt = moment(state.subscriptionExpiresAt)
    return (expiresAt.isValid()) ? expiresAt.local() : null
}

export function isSubscribed(state) {
    let apiKey = state.apiKey
    let expiresAt = getExpiresAt(state)
    if (apiKey && apiKey !== '' && expiresAt){
        let now = moment();
        return expiresAt >= now
    }
    return false;
}
