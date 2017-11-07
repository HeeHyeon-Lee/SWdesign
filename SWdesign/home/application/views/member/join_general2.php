
<article class="title">
    <h2 class="join">일반회원 가입</h2>
    <div>
        <span>&nbsp;</span>
    </div>
</article>

<nav class="lnb join">
    <ul class="three">
        <li>01 회원약관동의</li>
        <li class="on">02 회원정보 입력</li>
        <li>03 가입완료</li>
    </ul>
</nav>

<?php echo form_open_multipart('/member/join/ok'); ?>

<div class="termsForm">
    <div class="agreeHeader">
        <div class="agreeText">
            <p>아래 <strong class="cOrg">*</strong> 표시 된 내용은 필수입력사항입니다.</p>
        </div>
    </div>

    <div class="termsHeader">
        <p class="tit">기본정보</p>
    </div>
    <table class="bbs_write">
        <caption>기본정보</caption>
        <colgroup>
            <col style="width:30%" />
            <col style="width:70%" />
        </colgroup>
        <tbody>
            <tr>
                <th class="required">이메일</th>
                <td>
                    <input type="text" placeholder="ex) admin" name="id" required>
                    <span>@</span>
                    <input type="text" placeholder="ex) werun.pe.kr" name="domain" required>
                    <button class="tableBtn" type="button" name="dupChk">중복확인</button>
                </td>
            </tr>
            <tr>
                <th class="required">비밀번호</th>
                <td>
                    <input type="password" placeholder="8자 이상의 영문,숫자,특수문자 조합" name="password">
                    <input type="password" placeholder="패스워드 확인" name="password2">
                </td>
            </tr>
            <tr>
                    <th class = "required">이름</th>
                    <td><input type="text" placeholder="한글 or 영문 전체 이름 입력." name="name"></td>
            </tr>
            <tr>
                <th class = "required">닉네임</th>
                <td>
                <input type = "text" placeholder = "한글 or 영문, 2글자 이상" name ="nickname">
                </td>
            </tr>
            <tr>
                <th class = "required">생년월일</th>
                    <td>
                        <input type="text" placeholder="0000-00-00" name="bDate" />
                    </td>
            </tr>
            <tr>
                <th class = "required">전화번호</th>
                    <td>
                        <input type="text" placeholder="010-1234-5678" name="phone" />
                    </td>
            </tr>
            <tr>
                <th>주소</th>
                <td>
                    <p>
                        <button class="tableBtn" type="button" name="addrSearch">주소검색</button>
                        <input type="text" name="addr1" readonly="readonly" />
                    </p>

                    <p class="mt5">
                        <input type="text" name="addr2" placeholder="상세주소" />
                    </p>

                    <input type="hidden" name="zipCode" />
                </td>
            </tr>
        </tbody>
    </table>


    <div class="termsHeader">
        <p class="tit">선택정보</p>
    </div>
    <table class="bbs_write">
        <caption>기본정보</caption>
        <colgroup>
            <col style="width:30%" />
            <col style="width:70%" />
        </colgroup>
        <tbody>
            <tr>
                <th>관심있는 종목</th>
                <td>
                    <div class="parts">
                        <button class="tableBtn" type="button" name="1">야구</button>
                        <button class="tableBtn" type="button" name="2|3">배드민턴</button>
                        <button class="tableBtn" type="button" name="no">축구</button>
                        <button class="tableBtn" type="button" name="no">테니스</button>
                        <button class="tableBtn" type="button" name="no">League of Legends</button>
                    </div>
                </td>
            </tr>
            <tr>
                <th>이름공개여부</th>
                <td>

                <label for="public1">
                    <input type="radio" name="public" id="public1" value="Y" selected="selected" />
                    예
                </label>
                <label for="public2" class="ml10">
                    <input type="radio" name="public" id="public2" value="N" />
                    아니오(닉네임으로 공개)
                </label>

                </td>
            </tr>
            <tr>
                <th>프로필 이미지</th>
                <td>

                    <input type="file" name="profileImage">

                </td>
            </tr>
        </tbody>
    </table>

    <div class="buttonArea">
        <button type="button" class="txtBtn" onclick="history.back();">뒤로가기</button>
        <button type="reset" class="resetBtn">다시입력</button>
        <button type="submit" class="txtBtn bgBlue">회원가입</button>
    </div>
</div>

</form>



<script type="text/javascript">

/* 주소 받아주기 */
var jusoCallBack = function(addr1, addr2, addr3, zipcode){
    $("[name=addr1]").val(addr1);
    $("[name=addr2]").val(addr2+" "+addr3);
    $("[name=zipCode]").val(zipcode);
}

/* 주소검색 팝업 */
var goPopup = function(){
    var pop = window.open("/popup/juso","pop","width=570,height=440, scrollbars=yes, resizable=yes");
}

var chkDuplicate = function(){
    id = $("[name=email]");
    domain = $("[name=domain]");
    reChk = true;

    if(id.val() == "" || domain.val() == ""){
        alert("이메일을 확인해주세요.");
        return false;
        reChk = false;
    }

    $.ajax({
      type: "POST",
      url: "/member/join/chk",
      data: {
           id:     $("[name=email]").val(),
           domain: $("[name=domain]").val()
        },
      success:function(data){
        console.log(data);
      },
      error:function(request, status, error){
        console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
      }

    })

}

/*이벤트 설정 */
var setEvent = function(){
    $("[name=addr1]").click(function(){ goPopup(); });
    $("[name=addrSearch]").click(function(){ goPopup(); });
    $("[name=bDate]").datepicker();
    $("[name=dupChk]").click(function(){ chkDuplicate(); });
}

$(document).ready(function(){

    setEvent();

});
</script>