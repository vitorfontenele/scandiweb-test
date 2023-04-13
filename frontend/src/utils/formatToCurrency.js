const formatToCurrency = (num) => {
    const formattedNum = num.toFixed(2);

    return formattedNum.toString();
}

export default formatToCurrency;