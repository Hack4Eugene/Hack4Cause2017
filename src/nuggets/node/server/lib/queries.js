
module.exports = Object.freeze({
    INCOME: 'SELECT year, totalWages, avgWage, natHHMedIncome FROM eugeneOverview',
    EMPLOYMENT: 'SELECT year, unemployment, natUnemployment',
    PARKING: 'SELECT Violation, lat, lon FROM parkingCit2007',
    DEVELOPMENT_COM: 'SELECT permit_issued, proposed_use, existing_use, number_of_stories, lat, lng FROM employmentBP',
    DEVELOPMENT_RES: 'SELECT scope_of_work_desc, existing_use, project_name, lat, lng FROM housingBP',
    HOUSING: 'SELECT year, housingMed, rentMed, zhvi FROM eugeneOverview'
});
