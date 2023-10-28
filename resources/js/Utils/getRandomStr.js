const getRandomStr = (length) => {
  let randomStr = "";
  const characters =
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_";
  let counter = 0;
  while (counter < length) {
    randomStr += characters.charAt(
      Math.floor(Math.random() * characters.length)
    );
    counter += 1;
  }
  return randomStr;
};

export default getRandomStr;
