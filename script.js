function togglePassword(inputId,toggleBtnId)
{
  const input=document.getElementById(inputId);
  const btn=document.getElementById(toggleBtnId);
  if(input.type==="password")
  {
    input.type="text";
    btn.textContent="Hide";
  }
  else
  {
    input.type="password";
    btn.textContent="Show";
  }
}

function confirmUpload()
{
  return confirm("Are you sure you want to upload this file?");
}

function validateRegisterForm()
{
  const email=document.getElementById("email").value;
  const pwd=document.getElementById("password").value;
  const confirmPwd=document.getElementById("confirmPassword").value;
  if (!email.includes("@"))
  {
    alert("Please enter a valid email.");
  }
  if(pwd.length<6)
  {
    alert("Password must be atleast 6 characters.");
  }
  if(pwd!==confirmPwd)
  {
    alert("Passwords do not match.");
  }
  return true;
}

function highlightLinks()
{
  const links=document.querySelectorAll("a[download]");
  links.forEach(link=>{
    link.addEventListener("click",()=>{
      link.style.color="green";
      link.style.fontWeight="bold";
    })
  })
}

window.onload=function()
{
  highlightLinks();
}