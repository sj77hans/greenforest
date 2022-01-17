$(document).ready(function () {

	// enable fileuploader plugin
	$('input[name="files"]').fileuploader({
		limit: 8,
		fileMaxSize: 3,
		extensions: ['jpg', 'gif', 'png'],
		changeInput: ' ',
		theme: 'thumbnails',
		enableApi: true,
		addMore: true,
		thumbnails: {
			box: '<div class="fileuploader-items">' +
				'<ul class="fileuploader-items-list">' +
				'<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><i>+</i></div></li>' +
				'</ul>' +
				'</div>',
			item: '<li class="fileuploader-item">' +
				'<div class="fileuploader-item-inner">' +
				'<div class="type-holder"><button type="button" class="fileuploader-action fileuploader-action-sort" title="${captions.sort}"><i class="fileuploader-icon-sort"></i></button></div>' +
				'<div class="actions-holder">' +
				'<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
				'</div>' +
				'<div class="thumbnail-holder">' +
				'${image}' +
				'</div>' +
				'<div class="content-holder"><h5>${name}</h5><span>${size2}</span><br><input type="text" name="goods_img[]" value="${name}" required></div>' +
				'<div class="progress-holder">${progressBar}</div>' +
				'</div>' +
				'</li>',
			startImageRenderer: false,
			canvasImage: false,
			_selectors: {
				list: '.fileuploader-items-list',
				item: '.fileuploader-item',
				start: '.fileuploader-action-start',
				retry: '.fileuploader-action-retry',
				remove: '.fileuploader-action-remove'
			},
			onItemShow: function (item, listEl, parentEl, newInputEl, inputEl) {
				var plusInput = listEl.find('.fileuploader-thumbnails-input'),
					api = $.fileuploader.getInstance(inputEl.get(0));

				plusInput.insertAfter(item.html)[api.getOptions().limit && api.getChoosedFiles().length >= api.getOptions().limit ? 'hide' : 'show']();

				if (item.format == 'image') {
					item.html.find('.fileuploader-item-icon').hide();
				}
			},
			onItemRemove: function (html, listEl, parentEl, newInputEl, inputEl) {
				var plusInput = listEl.find('.fileuploader-thumbnails-input'),
					api = $.fileuploader.getInstance(inputEl.get(0));

				html.children().animate({ 'opacity': 0 }, 200, function () {
					html.remove();

					if (api.getOptions().limit && api.getChoosedFiles().length - 1 < api.getOptions().limit)
						plusInput.show();
				});
			}
		},
		dragDrop: {
			container: '.fileuploader-thumbnails-input'
		},
		afterRender: function (listEl, parentEl, newInputEl, inputEl) {
			var plusInput = listEl.find('.fileuploader-thumbnails-input'),
				api = $.fileuploader.getInstance(inputEl.get(0));

			plusInput.on('click', function () {
				api.open();
			});

			api.getOptions().dragDrop.container = plusInput;
		},
		upload: {
			url: './php/ajax_upload_file.php',
			data: null,
			type: 'POST',
			enctype: 'multipart/form-data',
			start: true,
			synchron: true,
			beforeSend: null,
			onSuccess: function (data, item) {
				item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');

				setTimeout(function () {
					item.html.find('.progress-holder').hide();
					item.renderThumbnail();

					item.html.find('.fileuploader-action-popup, .fileuploader-item-image').show();
				}, 400);
			},
			onError: function (item) {
				item.html.find('.progress-holder, .fileuploader-action-popup, .fileuploader-item-image').hide();
			},
			onProgress: function (data, item) {
				var progressBar = item.html.find('.progress-holder');

				if (progressBar.length > 0) {
					progressBar.show();
					progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
				}

				item.html.find('.fileuploader-action-popup, .fileuploader-item-image').hide();
			}
		},
		sorter: {
			selectorExclude: null,
			placeholder: null,
			scrollContainer: window,
			onSort: function (list, listEl, parentEl, newInputEl, inputEl) {
				var api = $.fileuploader.getInstance(inputEl.get(0)),
					fileList = api.getFileList(),
					_list = [];

				$.each(fileList, function (i, item) {
					_list.push({
						name: item.name,
						index: item.index
					});
				});

				$.post('php/ajax_sort_files.php', {
					_list: JSON.stringify(_list)
				});
			}
		},
		onRemove: function (item) {
			$.post('php/ajax_remove_file.php', {
				file: item.name
			});
		},
		captions: {
			button: function (options) {
				return 'Browse ' + (options.limit == 1 ? 'file' : 'files');
			},
			feedback: function (options) {
				return 'Choose ' + (options.limit == 1 ? 'file' : 'files') + ' to upload';
			},
			feedback2: function (options) {
				return options.length + ' ' + (options.length > 1 ? 'files were' : 'file was') + ' chosen';
			},
			confirm: 'Confirm',
			cancel: 'Cancel',
			name: 'Name',
			type: 'Type',
			size: 'Size',
			dimensions: 'Dimensions',
			duration: 'Duration',
			crop: 'Crop',
			rotate: 'Rotate',
			sort: '끌어서 순서 지정',
			download: 'Download',
			remove: '삭제',
			drop: 'Drop the files here to Upload',
			paste: '<div class="fileuploader-pending-loader"></div> Pasting a file, click here to cancel.',
			removeConfirmation: 'Are you sure you want to remove this file?',
			errors: {
				filesLimit: function (options) {
					return 'Only ${limit} ' + (options.limit == 1 ? 'file' : 'files') + ' can be uploaded.'
				},
				filesType: 'Only ${extensions} files are allowed to be uploaded.',
				fileSize: '${name} is too large! Please choose a file up to ${fileMaxSize}MB.',
				filesSizeAll: 'The chosen files are too large! Please select files up to ${maxSize} MB.',
				fileName: 'A file with the same name ${name} is already selected.',
				remoteFile: 'Remote files are not allowed.',
				folderUpload: 'Folders are not allowed.'
			}
		}
	});

});