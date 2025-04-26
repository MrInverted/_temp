/*

try {
  for (let form of document.forms) {
    const { action } = form;
  
    form.onsubmit = (e) => {
      e.preventDefault();
  
      const formData = new FormData(form);
  
      fetch(action, { method: 'POST', body: formData })
        .then(res => console.log(res))
        .catch(err => console.warn(err))
    }
  }
} catch (error) {
  console.debug(error);
}

*/