// AJAX for Laravel
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// Alert handler 
function alertHandel(text, type){
    $('#alert').html(`<span class="p-2 alert alert-${type} handel-alert">${text}</span>
    `)
    setTimeout(function(){
        $('.handel-alert').remove();
    }, 3000);
}

// Spener
const spener = `<div class="spinner-border spinner-sm" style="font-size: 9px; height: 20px;
width: 20px;" role="status"></div>`



// Add image file to src
$('#avatar').change(function () {
    let reader = new FileReader();
    reader.onload = (e) => {
        $('#avatar-view').attr('src', e.target.result);
        $('#avatar-view').removeClass('d-none');
        $('.avatar-placeholder').addClass('d-none')
        
    }
    reader.readAsDataURL(this.files[0]);
});



// Display togels
function display(togel){
    const togels = $('.togels');
    const toblBtn = $('.togel-btn');
    for(var i = 0; i < togels.length; i++){
        togels[i].classList.add('d-none');
        // $(`.${togel[i]}`).removeClass('bg-gradient-info');
        // $(`.${togel[i]}`).addClass('bg-gradient-defaul');
    }


    for(var i = 0; i < toblBtn.length; i++){
        toblBtn[i].classList.add('bg-gradient-defaul');
        toblBtn[i].classList.remove('bg-gradient-info');
    }
    $(`#${togel}`).removeClass('d-none');
    $(`.${togel}`).addClass('bg-gradient-info');
    $(`.${togel}`).removeClass('bg-gradient-defaul');

}


// Add Personel information
$('#form-personel').submit(function(e){
    e.preventDefault();

    $('#add-personel').attr('disabled', '')
    $('#add-personel').html(spener)
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(success){
            $('#add-personel').removeAttr('disabled')
            $('#add-personel').html(`Save`)


            // Add to cv template
            $('.first_name').text(formData.get('first_name'));
            $('.last_name').text(formData.get('last_name'));
            $('.email').text(formData.get('email'));
            $('.zip').text(formData.get('zip'));
            $('.phone').text(formData.get('phone'));
            $('.city').text(formData.get('city'));
            $('.cin').text(formData.get('cin'));
            $('.address').text(formData.get('address'));
            $('.bio').text(formData.get('bio'));
            $('.job').text(formData.get('job'));

            // var file = new FileReader()
            if(document.getElementById('avatar').files.length > 0){
                $('.avatar-view-cv').attr('src', URL.createObjectURL(document.getElementById('avatar').files[0]))

            }
             alertHandel('Personel information added successfully...', 'success');
        },
        error: function(error){
            $('#add-personel').removeAttr('disabled')
            $('#add-personel').html(`Save`)
            var itemError = JSON.parse(error.responseText).errors;
            alertHandel('Fail to Create Peronel information', 'danger')
            console.log(error);

        },
    })
    
});


// --------------------------------------------  Experience -----------------
// Add experience
$('#form-experience').submit(function(e){
    e.preventDefault();
    $('#add-experience').attr('disabled')
    $('#add-experience').html(spener)

    var formData = new FormData(this);
    $.ajax({
        url: $(this).attr('action'),
        data: formData,
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        success: function(data, success, response){
            console.log()
            // Display alert message
            alertHandel('Experience added successfully...', 'success')
            // Clear the form inputs
            document.getElementById('form-experience').reset()
            // Add expereince to CV template
            document.querySelector('.experience').innerHTML += `
            <div id='${data.id}-cv'>
                <h6 class="m-0 them-blue-text">${formData.get('experience')} <br>  <small class="float-end ">${formData.get('start_date')} / ${formData.get('end_date')}</small></h6><br>
                <div><small class="text-muted">${formData.get('description')}</small></div>
            </div>`

            // Add expereince to a list 

            document.getElementById('experience-table').innerHTML += (`
            <tr id='${data.id}-table'>
                <td>${formData.get('experience')} </td>
                <td>${formData.get('company')}</td>
                <td>
                    <button class="btn-success btn btn-sm rounded-pill" onclick="loadeExperience(${data.id})"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-danger btn btn-sm rounded-pill" onclick="deleteExperience(${data.id})"><i class="bi bi-trash"></i></button>
                </td>
          </tr>`)

        //   Add the defult btn
        $('#add-experience').removeAttr('disabled')
        $('#add-experience').html(`Save`)
        $('#experienc-thead').removeClass('d-none')
        },
        error: function(error){
            console.log(error)
        }
    });
});


// Loade Exprience to update
function loadeExperience(id){
   $.ajax({
        url: '/experience/get/'+ id,
        type: 'GET',
        async: true,
        success: function(data, seuccess, state){
            var item = data.experience
           $('#experience').val(item.experience)
           $('#company').val(item.company)
           $('#city-experience').val(item.city)
           $('#start_date').val(item.start_date)
           $('#end_date').val(item.end_date)
           $('#experienc-description').val(item.description)


           $('#update-experience').removeClass('d-none');
           $('#add-experience').addClass('d-none');

           $('#update-experience').attr('url', '/experience/update/'+id);
           $("html, body").animate({ scrollTop: 0 }, "slow");



        },
        error: function(error){
            console.log(error)
            alertHandel('Error...Please Reload page.', 'danger');
        }
   });

};

// Update Experiences 
$('#update-experience').click(function(e){
    $(this).html(spener);

    var form = document.getElementById('form-experience');
    var formData = new FormData(form);
    var url = $(this).attr('url');

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        success: function(data, success, states){
            var experience = data.experience;
            $('#update-experience').addClass('d-none');
            $('#add-experience').removeClass('d-none');
            // Add the (Update) to update btn
            $('#update-experience').html(`Update`);
            // Clean the form
            document.getElementById('form-experience').reset();
            // Add new update to HTML table
            $(`#${experience.id}-table`).html(`
                <td>${experience.experience} </td>
                <td>${experience.company}</td>
                <td>
                    <button class="btn-success btn btn-sm rounded-pill" onclick="loadeExperience(${experience.id})"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-danger btn btn-sm rounded-pill" onclick="deleteExperience(${experience.id})"><i class="bi bi-trash"></i></button>
                </td>
            `)

            // Add new update to HTML CV Tempate
            $(`#${experience.id}-cv`).html(`
            <h6 class="m-0 them-blue-text">${experience.experience} <br>  <small class="float-end ">${experience.start_date} / ${experience.end_date}</small></h6><br>
            <div><small class="text-muted">${experience.description}</small></div>
            `);

            alertHandel(data.message, 'success');

        },
        error: function(error){
            $('#update-experience').addClass('d-none');
            $('#add-experience').removeClass('d-none');
            alertHandel("Fail to edit Experience successfully...", 'danger');
            console.log(error)
        }
    })
});


// Delete Experience
function deleteExperience(id){
    if(confirm("Are you sur you wante to delete Experience...")){
        $.ajax({
            url: '/experience/delete/'+id,
            type: 'GET',
            async: true,
            success: function(data, success, response){
                alertHandel(data.message, 'success');
                $(`#${id}-table`).remove();
                $(`#${id}-cv`).remove();
                $('#update-experience').addClass('d-none');
                $('#add-experience').removeClass('d-none');
                document.getElementById('form-experience').reset();
            },
            error: function(error){

                alertHandel('Fail to delete Experience. Please refresh the page', 'danger');
            }
        });
    }
}

// ----------------------------------- Diplome ----------------------------


// Create diplome
$('#form-diplome').submit(function(e){
    e.preventDefault();
    const url = $(this).attr('action');
    const data = new FormData(this);

    $('#add-diplome').html(spener);
    $('#add-diplome').attr('disabled', '')

    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        success: function(data, success, state){
            alertHandel(data.message, 'success');

            $('#add-diplome').html('Save');
            $('#add-diplome').removeAttr('disabled');
            document.getElementById('form-diplome').reset();


            const diplome = data.diplome;
            $('#diplome-table').append(`
            <tr id="${ diplome.id }-diplome">
                <td>${ diplome.diplome }</td>
                <td>${ diplome.establishment }</td>
                 <td>
                    <button class="btn-success btn btn-sm rounded-pill update-diplome" onclick="loadeDiplome(${ diplome.id })"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-danger btn btn-sm rounded-pill" onclick="deleteDiplome(${ diplome.id })"><i class="bi bi-trash"></i></button>
                </td>
            </tr>
            `)
            $('.diplome').append(`
            <div id="${ diplome.id }-diplome-cv">
                <h6 class="m-0 them-blue-text">${ diplome.diplome } at ${ diplome.establishment } <br> <small class="float-end ">${ diplome.date_obtained }</small></h6><br>
                <div><small class="text-muted">${ diplome.description }</small></div>
            </div>
            `)
        },
        error: function(error){
            $('#add-diplome').html('Save');
            $('#add-diplome').removeAttr('disabled')
        }
    });
})


// Loade Diplome to update
function loadeDiplome(id){
    $.ajax({
         url: '/diplome/get/'+ id,
         type: 'GET',
         async: true,
         success: function(data, seuccess, state){
             var item = data.diplome
            $('#diplome').val(item.diplome)
            $('#establishment').val(item.establishment)
            $('#city-diplome').val(item.city)
            $('#date_obtained').val(item.date_obtained)
            $('#description-diplome').val(item.description)
 
 
            $('#update-diplome').removeClass('d-none');
            $('#add-diplome').addClass('d-none');
 
            $('#update-diplome').attr('url', '/diplome/update/'+id);
            $("html, body").animate({ scrollTop: 0 }, "slow");
 
         },
         error: function(error){
             alertHandel('Error...Please Reload page.', 'danger');
         }
    });
 
 };




 // Update diplome 
$('#update-diplome').click(function(e){
    $(this).html(spener);

    var form = document.getElementById('form-diplome');
    var formData = new FormData(form);
    var url = $(this).attr('url');

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        success: function(data, success, states){
            var diplome = data.diplome;
            $('#update-diplome').addClass('d-none');
            $('#add-diplome').removeClass('d-none');
            // Add the (Update) to update btn
            $('#update-diplome').html(`Update`);
            // Clean the form
            document.getElementById('form-diplome').reset();
            // Add new update to HTML table
            $(`#${diplome.id}-diplome`).html(`
                <td>${diplome.diplome} </td>
                <td>${diplome.establishment}</td>
                <td>
                    <button class="btn-success btn btn-sm rounded-pill" onclick="loadeDiplome(${diplome.id})"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-danger btn btn-sm rounded-pill" onclick="deleteDiplome(${diplome.id})"><i class="bi bi-trash"></i></button>
                </td>
            `)

            // Add new update to HTML CV Tempate
            $(`#${diplome.id}-diplome-cv`).html(`
            <h6 class="m-0 them-blue-text">${diplome.diplome} at ${diplome.establishment } <br>  <small class="float-end ">${diplome.date_obtained} </small></h6><br>
            <div><small class="text-muted">${diplome.description}</small></div>
            `);

            alertHandel(data.message, 'success');

        },
        error: function(errro){
            alertHandel("Fail to edit Diplome successfully...", 'danger');
        }
    })
});

// Delete Diplome
function deleteDiplome(id){
    if(confirm("Are you sur you wante to delete Diplome...")){
        $.ajax({
            url: '/diplome/delete/'+id,
            type: 'GET',
            async: true,
            success: function(data, success, response){
                alertHandel(data.message, 'success');
                $(`#${id}-diplome`).remove();
                $(`#${id}-diplome-cv`).remove();
                $('#update-diplome').addClass('d-none');
                $('#add-diplome').removeClass('d-none');
                document.getElementById('form-diplome').reset();
            },
            error: function(error){
                alertHandel('Fail to delete Diplome. Please refresh the page', 'danger');
            }
        });
    }
}



// ----------------------------------- language ----------------------------


// Create language
$('#form-language').submit(function(e){
    e.preventDefault();
    const url = $(this).attr('action');
    const data = new FormData(this);

    $('#add-language').html(spener);
    $('#add-language').attr('disabled', '')

    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        success: function(data, success, state){
            alertHandel(data.message, 'success');

            $('#add-language').html('Save');
            $('#add-language').removeAttr('disabled');
            document.getElementById('form-language').reset();


            const language = data.language;
            $('#language-table').append(`
            <tr id="${ language.id }-language">
                <td>${ language.language }</td>
                <td>${ language.level } %</td>
                 <td>
                    <button class="btn-success btn btn-sm rounded-pill update-language" onclick="loadeLanguage(${ language.id })"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-danger btn btn-sm rounded-pill" onclick="deleteLanguage(${ language.id })"><i class="bi bi-trash"></i></button>
                </td>
            </tr>
            `)
            $('.languages').append(`
            <div id='${ language.id }-language-cv'>
                <h6 class="m-0"><small dir="auto">${ language.language }</small></h6>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: ${language.level}%;" aria-valuenow="${language.level}" aria-valuemin="0" aria-valuemax="100">${language.level}%</div>
                </div>
            </div>
            `)
        },
        error: function(error){
            $('#add-language').html('Save');
            $('#add-language').removeAttr('disabled')
            alertHandel('Created fail... Pleas refresh the page.')
        }
    });
})

// Loade Language to update
function loadeLanguage(id){
    $.ajax({
         url: '/language/get/'+ id,
         type: 'GET',
         async: true,
         success: function(data, seuccess, state){
             var item = data.language
            $('#language').val(item.language)
            $('#langeuage-level').val(item.level)
 
            $('#update-language').removeClass('d-none');
            $('#add-language').addClass('d-none');
 
            $('#update-language').attr('url', '/language/update/'+id);
            $("html, body").animate({ scrollTop: 0 }, "slow");
 
         },
         error: function(error){
             alertHandel('Error...Please Reload page.', 'danger');
         }
    });
 
 };



  // Update Language 
$('#update-language').click(function(e){
    $(this).html(spener);

    var form = document.getElementById('form-language');
    var formData = new FormData(form);
    var url = $(this).attr('url');

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        success: function(data, success, states){
            var language = data.language;
            $('#update-language').addClass('d-none');
            $('#add-language').removeClass('d-none');
            // Add the (Update) to update btn
            $('#update-language').html(`Update`);
            // Clean the form
            document.getElementById('form-language').reset();
            // Add new update to HTML table
            $(`#${language.id}-language`).html(`
                <td>${ language.language }</td>
                <td>${ language.level } %</td>
                <td>
                    <button class="btn-success btn btn-sm rounded-pill update-language" onclick="loadeLanguage(${ language.id })"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-danger btn btn-sm rounded-pill" onclick="deleteLanguage(${ language.id })"><i class="bi bi-trash"></i></button>
                </td>
            `)

            // Add new update to HTML CV Tempate
            $(`#${language.id}-language-cv`).html(`
                <h6 class="m-0"><small dir="auto">${ language.language }</small></h6>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: ${language.level}%;" aria-valuenow="${language.level}" aria-valuemin="0" aria-valuemax="100">${language.level}%</div>
                </div>
            `);

            alertHandel(data.message, 'success');

        },
        error: function(errro){
            alertHandel("Fail to edit Language successfully...", 'danger');
        }
    })
});


// Delete language
function deleteLanguage(id){
    if(confirm("Are you sur you wante to delete Language...")){
        $.ajax({
            url: '/language/delete/'+id,
            type: 'GET',
            async: true,
            success: function(data, success, response){
                alertHandel(data.message, 'success');
                $(`#${id}-language`).remove();
                $(`#${id}-language-cv`).remove();
                $('#update-language').addClass('d-none');
                $('#add-language').removeClass('d-none');
                document.getElementById('form-language').reset();
            },
            error: function(error){
                alertHandel('Fail to delete Language. Please refresh the page', 'danger');
            }
        });
    }
}


// ------------------------------------- Skills --------


// Create Skills
$('#form-skill').submit(function(e){
    e.preventDefault();
    const url = $(this).attr('action');
    const data = new FormData(this);

    $('#add-skill').html(spener);
    $('#add-skill').attr('disabled', '')

    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        success: function(data, success, state){
            alertHandel(data.message, 'success');

            $('#add-skill').html('Save');
            $('#add-skill').removeAttr('disabled');
            document.getElementById('form-skill').reset();


            const skill = data.skill;
            $('#skill-table').append(`
            <tr id="${ skill.id }-skill">
                <td>${ skill.skill }</td>
                <td>${ skill.level } %</td>
                 <td>
                    <button class="btn-success btn btn-sm rounded-pill update-skill" onclick="loadeSkill(${ skill.id })"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-danger btn btn-sm rounded-pill" onclick="deleteSkill(${ skill.id })"><i class="bi bi-trash"></i></button>
                </td>
            </tr>
            `)
            $('.skills').append(`
            <div id='${ skill.id }-skill-cv'>
                <h6 class="m-0"><small dir="auto">${ skill.skill }</small></h6>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: ${skill.level}%;" aria-valuenow="${skill.level}" aria-valuemin="0" aria-valuemax="100">${skill.level}%</div>
                </div>
            </div>
            `)
        },
        error: function(error){
            $('#add-skill').html('Save');
            $('#add-skill').removeAttr('disabled')
            alertHandel('Created fail... Pleas refresh the page.')
        }
    });
})

// Loade skill to update
function loadeSkill(id){
    $.ajax({
         url: '/skill/get/'+ id,
         type: 'GET',
         async: true,
         success: function(data, seuccess, state){
             var item = data.skill
            $('#skill').val(item.skill)
            $('#langeuage-level').val(item.level)
 
            $('#update-skill').removeClass('d-none');
            $('#add-skill').addClass('d-none');
 
            $('#update-skill').attr('url', '/skill/update/'+id);
            $("html, body").animate({ scrollTop: 0 }, "slow");
 
         },
         error: function(error){
             alertHandel('Error...Please Reload page.', 'danger');
         }
    });
 
 };



  // Update skill 
$('#update-skill').click(function(e){
    $(this).html(spener);

    var form = document.getElementById('form-skill');
    var formData = new FormData(form);
    var url = $(this).attr('url');

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        success: function(data, success, states){
            var skill = data.skill;
            $('#update-skill').addClass('d-none');
            $('#add-skill').removeClass('d-none');
            // Add the (Update) to update btn
            $('#update-skill').html(`Update`);
            // Clean the form
            document.getElementById('form-skill').reset();
            // Add new update to HTML table
            $(`#${skill.id}-skill`).html(`
                <td>${ skill.skill }</td>
                <td>${ skill.level } %</td>
                <td>
                    <button class="btn-success btn btn-sm rounded-pill update-skill" onclick="loadeSkill(${ skill.id })"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-danger btn btn-sm rounded-pill" onclick="deleteSkill(${ skill.id })"><i class="bi bi-trash"></i></button>
                </td>
            `)

            // Add new update to HTML CV Tempate
            $(`#${skill.id}-skill-cv`).html(`
                <h6 class="m-0"><small dir="auto">${ skill.skill }</small></h6>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: ${skill.level}%;" aria-valuenow="${skill.level}" aria-valuemin="0" aria-valuemax="100">${skill.level}%</div>
                </div>
            `);

            alertHandel(data.message, 'success');

        },
        error: function(errro){
            alertHandel("Fail to edit skill successfully...", 'danger');
        }
    })
});


// Delete skill
function deleteSkill(id){
    if(confirm("Are you sur you wante to delete skill...")){
        $.ajax({
            url: '/skill/delete/'+id,
            type: 'GET',
            async: true,
            success: function(data, success, response){
                alertHandel(data.message, 'success');
                $(`#${id}-skill`).remove();
                $(`#${id}-skill-cv`).remove();
                $('#update-skill').addClass('d-none');
                $('#add-skill').removeClass('d-none');
                document.getElementById('form-skill').reset();
            },
            error: function(error){
                alertHandel('Fail to delete skill. Please refresh the page', 'danger');
            }
        });
    }
}





// ---------------------------- Hobby ------------------



// Create Skills
$('#form-hobby').submit(function(e){
    e.preventDefault();
    const url = $(this).attr('action');
    const data = new FormData(this);

    $('#add-hobby').html(spener);
    $('#add-hobby').attr('disabled', '')

    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        success: function(data, success, state){
            alertHandel(data.message, 'success');

            $('#add-hobby').html('Save');
            $('#add-hobby').removeAttr('disabled');
            document.getElementById('form-hobby').reset();


            const hobby = data.hobby;
            $('#hobby-table').append(`
            <tr id="${ hobby.id }-hobby">
                <td>${ hobby.hobby }</td>
                 <td>
                    <button class="btn-success btn btn-sm rounded-pill update-hobby" onclick="loadeHobby(${ hobby.id })"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-danger btn btn-sm rounded-pill" onclick="deleteHobby(${ hobby.id })"><i class="bi bi-trash"></i></button>
                </td>
            </tr>
            `)
            $('.hobbies').append(`
                <li id="${ hobby.id }-hobby-cv">- ${ hobby.hobby } </li>
            `)
        },
        error: function(error){
            $('#add-hobby').html('Save');
            $('#add-hobby').removeAttr('disabled')
            alertHandel('Created fail... Please refresh the page.')
        }
    });
})

// Loade hobby to update
function loadeHobby(id){
    $.ajax({
         url: '/hobby/get/'+ id,
         type: 'GET',
         async: true,
         success: function(data, seuccess, state){
             var item = data.hobby
            $('#hobby').val(item.hobby)
            $('#langeuage-level').val(item.level)
 
            $('#update-hobby').removeClass('d-none');
            $('#add-hobby').addClass('d-none');
 
            $('#update-hobby').attr('url', '/hobby/update/'+id);
            $("html, body").animate({ scrollTop: 0 }, "slow");
 
         },
         error: function(error){
             alertHandel('Error...Please Reload page.', 'danger');
         }
    });
 
 };



  // Update hobby 
$('#update-hobby').click(function(e){
    $(this).html(spener);

    var form = document.getElementById('form-hobby');
    var formData = new FormData(form);
    var url = $(this).attr('url');

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        success: function(data, success, states){
            var hobby = data.hobby;
            $('#update-hobby').addClass('d-none');
            $('#add-hobby').removeClass('d-none');
            // Add the (Update) to update btn
            $('#update-hobby').html(`Update`);
            // Clean the form
            document.getElementById('form-hobby').reset();
            // Add new update to HTML table
            $(`#${hobby.id}-hobby`).html(`
                <td>${ hobby.hobby }</td>
                <td>
                    <button class="btn-success btn btn-sm rounded-pill update-hobby" onclick="loadeHobby(${ hobby.id })"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn-danger btn btn-sm rounded-pill" onclick="deleteHobby(${ hobby.id })"><i class="bi bi-trash"></i></button>
                </td>
            `)

            // Add new update to HTML CV Tempate
            $(`#${hobby.id}-hobby-cv`).html(hobby.hobby);

            alertHandel(data.message, 'success');

        },
        error: function(errro){
            alertHandel("Fail to edit hobby successfully...", 'danger');
        }
    })
});


// Delete hobby
function deleteHobby(id){
    if(confirm("Are you sur you wante to delete hobby...")){
        $.ajax({
            url: '/hobby/delete/'+id,
            type: 'GET',
            async: true,
            success: function(data, success, response){
                alertHandel(data.message, 'success');
                $(`#${id}-hobby`).remove();
                $(`#${id}-hobby-cv`).remove();
                $('#update-hobby').addClass('d-none');
                $('#add-hobby').removeClass('d-none');
                document.getElementById('form-hobby').reset();
            },
            error: function(error){
                alertHandel('Fail to delete hobby. Please refresh the page', 'danger');
            }
        });
    }
}







