!function(){!async function(){try{const t="/api/tareas?url="+s(),a=await fetch(t),n=await a.json();e=n.tareas,o()}catch(e){console.log(e)}}();let e=[],t=[];document.querySelector("#agregar-tarea").addEventListener("click",(function(){n(!1)}));function a(a){const n=a.target.value;t=""!==n?e.filter(e=>e.Estado===n):[],d(),o()}function o(){!function(){const t=e.filter(e=>"0"===e.Estado),a=document.querySelector("#pendientes");0===t.length?a.disabled=!0:a.disabled=!1}(),function(){const t=e.filter(e=>"1"===e.Estado),a=document.querySelector("#completadas");0===t.length?a.disabled=!0:a.disabled=!1}();const a=t.length?t:e;if(0===a.length){const e=document.querySelector("#listado-tareas"),t=document.createElement("LI");t.textContent="No hay tareas que mostrar de este proyecto",t.classList.add("no-tareas"),e.appendChild(t)}const r={0:"Pendiente",1:"Completa"};a.forEach(t=>{const a=document.createElement("LI");a.dataset.tareaId=t.id,a.classList.add("tarea");const i=document.createElement("P");i.textContent=t.nombre,i.ondblclick=function(){n(!0,{...t})};const l=document.createElement("DIV");l.classList.add("opciones");const u=document.createElement("button");u.classList.add("estado-tarea"),u.classList.add((""+r[t.Estado]).toLowerCase()),u.dataset.estadoTarea=t.Estado,u.textContent=r[t.Estado],u.onclick=function(){!function(e){const t="1"===e.Estado?"0":"1";e.Estado=t,c(e)}({...t})};const m=document.createElement("BUTTON");m.classList.add("eliminar-tarea"),m.dataset.idTarea=t.id,m.textContent="Eliminar",m.onclick=function(){!function(t){Swal.fire({title:"Eliminar Tarea",showCancelButton:!0,confirmButtonText:"Sí",cancelButtonText:"No"}).then(a=>{a.isConfirmed&&async function(t){const{Estado:a,id:n,nombre:r}=t,c=new FormData;c.append("id",n),c.append("nombre",r),c.append("Estado",a),c.append("proyectoId",s());try{const a="http://localhost:3000/api/tarea/eliminar",n=await fetch(a,{method:"POST",body:c}),r=await n.json();r.resultado&&(Swal.fire("Tarea Eliminada",r.resultado.mensaje,"success"),e=e.filter(e=>e.id!==t.id),d(),o())}catch(e){console.log(e)}}(t)})}({...t})},l.appendChild(u),l.appendChild(m),a.appendChild(i),a.appendChild(l);document.querySelector("#listado-tareas").appendChild(a)})}function n(t=!1,a={}){const n=document.createElement("DIV");n.classList.add("modal"),n.innerHTML=`\n        <form class = "formulario nueva-tarea">\n            <legend>${t?"Editar Tarea":"Añade una nueva tarea"}</legend>\n            <div class="campo">\n                <label for="tarea">Tarea</label>\n                <input type="text" name="tarea" id="tarea" placeholder="${a.nombre?"Modificar el nombre de la tarea":"Añadir tarea al proyecto actual"}" \n                value="${a.nombre?a.nombre:""}">\n            </div>\n            <div class="opciones">\n                <input type="submit" value="${a.nombre?"Guardar Cambios":"Añadir Tarea"}" class="submit-nueva-tarea">\n                <button type="button" class="cerrar-modal">Cancelar</button> \n            </div>\n        </form>\n        `,setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},0),n.addEventListener("click",(function(i){i.preventDefault();const l=document.querySelector(".formulario");if(i.target.classList.contains("cerrar-modal")&&(l.classList.add("cerrar"),setTimeout(()=>{n.remove()},100)),i.target.classList.contains("submit-nueva-tarea")){const n=document.querySelector("#tarea").value.trim();if(""==n){return function(e,t){e.forEach(e=>{t===e.textContent&&(console.log("Borrando alerta"),e.remove())})}(document.querySelectorAll("form .alerta"),"El nombre de la tarea es obligatorio"),void r("El nombre de la tarea es obligatorio","error",document.querySelector(".formulario legend"))}t?(a.nombre=n,c(a)):async function(t){const a=new FormData;a.append("nombre",t),a.append("proyectoId",s());try{const n="http://localhost:3000/api/tarea",c=await fetch(n,{method:"POST",body:a}),s=await c.json();if(r(s.mensaje,s.tipo,document.querySelector(".formulario legend")),"exito"===s.tipo){const a=document.querySelector(".modal");setTimeout(()=>{a.remove()},2e3);const n={id:s.id,nombre:t,Estado:"0",proyectoId:s.proyectoId};e=[...e,n],d(),o()}}catch(e){console.log(e)}}(n)}})),document.querySelector(".dashboard").appendChild(n)}function r(e,t,a){const o=document.createElement("DIV");o.classList.add("alerta",t),o.textContent=e,a.parentElement.insertBefore(o,a.nextElementSibling),setTimeout(()=>{o.remove()},3e3)}async function c(t){const{Estado:a,id:n,nombre:r,proyectoId:c}=t,i=new FormData;i.append("id",n),i.append("nombre",r),i.append("Estado",a),i.append("proyectoId",s());try{const t="http://localhost:3000/api/tarea/actualizar",c=await fetch(t,{method:"POST",body:i}),s=await c.json();if("exito"===s.respuesta.tipo){Swal.fire(s.respuesta.mensaje,s.respuesta.mensaje,"success");const t=document.querySelector(".modal");t&&t.remove(),e=e.map(e=>(e.id===n&&(e.Estado=a,e.nombre=r),e))}d(),o()}catch(e){console.log(e)}}function s(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).url}function d(){const e=document.querySelector("#listado-tareas");for(;e.firstChild;)e.removeChild(e.firstChild)}document.querySelectorAll('#filtros input[type="radio"]').forEach(e=>{e.addEventListener("input",a)})}();