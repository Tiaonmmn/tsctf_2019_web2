<?php
/**
 * UCenter Ӧ�ó��򿪷� Example
 *
 * Ӧ�ó������Լ����û������û���¼�� Example ����
 * ʹ�õ��Ľӿں�����
 * uc_user_login()	���룬�жϵ�¼�û�����Ч��
 * uc_authcode()	��ѡ�������û����ĵĺ����ӽ��ܼ����ִ��� Cookie
 * uc_user_synlogin()	��ѡ������ͬ����¼�Ĵ���
 */

if(empty($_POST['submit'])) {
	//��¼����
	echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'?example=login">';
	echo '��¼:';
	echo '<dl><dt>�û���</dt><dd><input name="username"></dd>';
	echo '<dt>����</dt><dd><input name="password" type="password"></dd></dl>';
	echo '<input name="submit" type="submit"> ';
	echo '</form>';
} else {
	//ͨ���ӿ��жϵ�¼�ʺŵ���ȷ�ԣ�����ֵΪ����
	list($uid, $username, $password, $email) = uc_user_login($_POST['username'], $_POST['password']);

	setcookie('Example_auth', '', -86400);
	if($uid > 0) {
		if(!$db->result_first("SELECT count(*) FROM {$tablepre}members WHERE uid='$uid'")) {
			//�ж��û��Ƿ�������û���������������ת������ҳ��
			$auth = rawurlencode(uc_authcode("$username\t".time(), 'ENCODE'));
			echo '����Ҫ��Ҫ������ʺţ����ܽ��뱾Ӧ�ó���<br><a href="'.$_SERVER['PHP_SELF'].'?example=register&action=activation&auth='.$auth.'">����</a>';
			exit;
		}
		//�û���¼�ɹ������� Cookie������ֱ���� uc_authcode �������û�ʹ���Լ��ĺ���
		setcookie('Example_auth', uc_authcode($uid."\t".$username, 'ENCODE'));
		//����ͬ����¼�Ĵ���
		$ucsynlogin = uc_user_synlogin($uid);
		echo '��¼�ɹ�'.$ucsynlogin.'<br><a href="'.$_SERVER['PHP_SELF'].'">����</a>';
		exit;
	} elseif($uid == -1) {
		echo '�û�������,���߱�ɾ��';
	} elseif($uid == -2) {
		echo '�����';
	} else {
		echo 'δ����';
	}
}

?>