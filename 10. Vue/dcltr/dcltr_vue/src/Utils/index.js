export const getDateTime = (dateTime) => {
  let myDate = new Date(dateTime);
  return `${myDate.getUTCDate()}/${myDate.getUTCMonth() + 1}/${myDate.getUTCFullYear()} - ${myDate.getHours()}:${myDate.getMinutes()}:${myDate.getSeconds()}`;
};

export const capitalizeFirstLetter = (string) => {
  return string.charAt(0).toUpperCase() + string.slice(1);
}
export const removeUnderScore = (string) => {
  let newString = string.replace(/_/g, ' ');
  return newString.charAt(0).toUpperCase() + newString.slice(1);
}

export const removeSpaceAddUnderScore = (string) => {
  let newString = string.replace(/ /g, '_');
  return newString.charAt(0).toUpperCase() + newString.slice(1);
}

export const getTimeStampFromDate = (string) => {
  return new Date(string).getTime('d-m-Y');
}
