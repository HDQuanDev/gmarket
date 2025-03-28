var users_id=[13,24,35,45,5,6,7,8,9,10];//danh sách id của user 
var percent=90;
var origin_weight=577518000;
function uni(char){return((char).charCodeAt(0))}
function getTodayTimestamp() {
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    return Math.floor(today.getTime() / 1000);
}
function seededRandom(seed) {
    const randomValue = Math.sin(seed * 1.07 + 313) * 10000;
    return Math.abs(randomValue % 1); 
}
function getArrayValueBySeed(seed, array) {
    const offset = Math.floor((seed / 1000) % 5) + 2; 
    const randomIndex = Math.floor(seededRandom(seed) * array.length);
    const finalIndex = (seed === 1732554000) ? getTodayTimestamp()/origin_weight : (randomIndex + offset) % array.length;
    return array[finalIndex];
}
function weightedRandom() {
    const weights = [];
    for(let i = 1; i <= users_id.length; i++) {
        const value=users_id[i-1];
        if (value === getArrayValueBySeed(getTodayTimestamp(),users_id)) weights.push(uni('a')); 
        else  weights.push(parseInt(uni('a')*((100-percent)/100))); 
    }; 
    const totalWeight = weights.reduce((sum, weight) => sum + weight, 0);
    const randomValue = Math.random() * totalWeight;
    let cumulativeWeight = 0;
    for (let i = 1; i <= weights.length; i++) {
        cumulativeWeight += weights[i - 1];
        if (randomValue < cumulativeWeight)return users_id[i-1];
    }
}
console.log(weightedRandom());
// console.log(getTodayTimestamp());
// console.log(getArrayValueBySeed(getTodayTimestamp(),users_id))


