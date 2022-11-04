const checkbox = document.querySelector('.customCheck'),
	  showHidePwd = document.querySelectorAll('.ShowHidePwd'),
	  pwdFiedls = document.querySelectorAll('.password');


// hide/show password icon changes
	showHidePwd.forEach(eyeIcon =>{
		eyeIcon.addEventListener('click', () => {
			pwdFiedls.forEach(pwdFiedl => {
				if (pwdFiedl.type === "password") {
                    checkbox.setAttribute("checked", "")
					pwdFiedl.type = "text"
					showHidePwd.forEach(icon =>{
						icon.classList.replace("fa-eye-slash", "fa-eye")
					})
				}else{
                    checkbox.removeAttribute("checked", "")
					pwdFiedl.type = "password"
					showHidePwd.forEach(icon =>{
						icon.classList.replace("fa-eye", "fa-eye-slash")
					})
				}
			})
		})
        checkbox.addEventListener('click', () => {
			pwdFiedls.forEach(pwdFiedl => {
				if (pwdFiedl.type === "password") {
					pwdFiedl.type = "text"
					showHidePwd.forEach(icon =>{
						icon.classList.replace("fa-eye-slash", "fa-eye")
					})
				}else{
					pwdFiedl.type = "password"
					showHidePwd.forEach(icon =>{
						icon.classList.replace("fa-eye", "fa-eye-slash")
					})
				}
			})
		})
	})