set wildignore+=tests/_reports/*
let g:ctrlp_custom_ignore.dir .= '\|_reports'
nnoremap !! :!composer test<CR>
