window.enjoyhint_script_steps=[];
$(window).load(function () {
	var now = new Date();
	if (SebekonHelper.hitTime == null ||  Date.parse(SebekonHelper.hitTime)+ SebekonHelper.maxHitTime < now.getTime() ) {
		
		var enjoyhint_instance = new EnjoyHint({});
		window.enjoyhint_script_steps.push(
			{
				'next .breadcrumb__fakultet' : 'В любой момент вы можете изменить просматриваемое направление обучения',
				'nextButton' : {className: "myNext", text: "Далее"},
				'skipButton' : {className: "mySkip", text: "Закрыть"}
			},
			{
				'next .es-user__info__student' : 'Вы находитесь на странице своего профиля. В него всегда можно попасть через Ваше имя в шапке сайта',
				'nextButton' : {className: "myNext", text: "Далее"},
				'skipButton' : {className: "mySkip", text: "Закрыть"}
			},
			{
				'next .es-personal__photo' : 'Здесь Вы можете изменить свое фото',
				'nextButton' : {className: "myNext", text: "Далее"},
				'skipButton' : {className: "mySkip", text: "Закрыть"}
			},
			{
				'click .personal__tabs-header__addition-cont' : 'Нажмите на дополнительные контакты',
				// 'nextButton' : {className: "myNext", text: "Далее"},
				'skipButton' : {className: "mySkip", text: "Закрыть"}
			},
			{
				'next .es-btn--edit_addition' : 'Тут можно указать Ваши актуальные контакты, и они будут переданы в ВУЗ',
				'nextButton' : {className: "myNext", text: "Далее"},
				'skipButton' : {className: "mySkip", text: "Закрыть"}
			},
			{
				'next .my__training__title--text' : 'Здесь расположен весь список Ваших вариантов обучения',
				'nextButton' : {className: "myNext", text: "Далее"},
				'skipButton' : {className: "mySkip", text: "Закрыть"}
			},
			{
				'next .es-training__line-orders' : 'Также Вы можете посмотреть список приказов про Вас. Если они скрыты - разверните их',
				'nextButton' : {className: "myNext", text: "Далее"},
				'skipButton' : {className: "mySkip", text: "Закрыть"}
			},
			{
				'next .es-training__title-hint-close-dummy' : 'Каждый блок обучения тоже можно свернуть',
				'nextButton' : {className: "myNext", text: "Далее"},
				'skipButton' : {className: "mySkip", text: "Закрыть"}
			},
			{
				'next .es-rightmenu' : 'В левом меню есть все доступные<br> Вам разделы личного кабинета.<br> Все данные в этих разделах будут<br> относиться к выбранному Вами<br> направлению обучения',
				'nextButton' : {className: "myNext", text: "Далее"},
				'skipButton' : {className: "mySkip", text: "Закрыть"}
			},
			{
				'finish .support-link' : 'На этом вводный курс закончен. А если у Вас возникнут сложности при работе с личным кабинетом - отправьте запрос в нашу службу техподдержки',
				'nextButton' : {className: "myNext", text: "Далее"},
				'skipButton' : {className: "mySkip", text: "Закрыть"}
			}
			)

		enjoyhint_instance.set(enjoyhint_script_steps);
		enjoyhint_instance.run();
        sessionStorage.setItem('hittime', now);
	 }
});