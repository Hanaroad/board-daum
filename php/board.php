<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/boardEditor.css" />
    <title>글쓰기</title>
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script> -->
    <!-- <script type="text/javascript">
    function saveContent() {
        if (jQuery("#title").val() == "" || jQuery('#id').val() == "") {
            alert(`${id}을 입력해 주세요.`);
            jQuery("#title").focus();
            return;
        }

        Editor.save(); // 이 함수를 호출하여 글을 등록하면 된다.
    }
    </script> -->
</head>

<body>
    <div class="frmParent">
        <form name="tx_editor_form" id="tx_editor_form" method="post" enctype="multipart/form-data"
            accept-charset="utf-8">
            <div class="keyStyle">
                <div>
                    제 목&nbsp;&nbsp; <input type="text" id="title" class="inputStyle" name="title" />
                </div>
                <div>
                    글쓴이&nbsp; <input id="id" class="inputStyle" type='text' />
                </div>
                <div>
                    첨부파일&nbsp; <input id="attachedFile" class="inputStyle fileInput" type='file' />
                </div>
            </div>
            <div class="content">
                <?php
                    include_once ("../daumEditor/editor.html");      // 다음 에디터를 include 한다.
                ?>
                <div class="btnLocation"><input id="btnRegist" class="btnReg" type="submit" value="등록"
                        onClick="saveContent();" /></div>
                <!-- <div class="btnLocation"><input id="btnRegist" class="btnReg" type="submit" value="등록" /></div> -->
            </div>
        </form>
    </div>
</body>

</html>
<script>
// declare
const title = document.getElementById('title');
const id = document.getElementById('id');
const attachedFile = document.getElementById('attachedFile');
const btnRegist = document.getElementById('btnRegist');

// DOMContentLoaded
window.addEventListener('DOMContentLoaded', () => {
    btnRegist.addEventListener('click', (e) => {
        e.preventDefault();

        if (title.value == '') {
            alert('제목을 입력하세요');
            return false;
        }
        if (id.value == '') {
            alert('글쓴이를 입력하세요');
            return false;
        }
        // if (id.value == '') {
        //     alert('글쓴이를 입력하세요');
        //     return false;
        // }
    })

    const payload = new FormData(tx_editor_form);

    // Send form data to server
    if (validateFormData(payload)) {
        fetch('/php/regist.php', {
                method: 'POST',
                body: payload,
            })
            .then((res) => {
                if (!res.ok) {
                    throw new Error('네트워크 통신이 원활하지 않습니다.');
                }
                return res.text();
            })
            .then((data) => {
                if (data) {
                    throw new Error(data);
                } else {
                    getBoardList();
                }
            })
            .catch((error) => {
                alert(error);
            });
    }
});

function saveContent() {
    Editor.save()
}

function validateFormData() {

};
</script>