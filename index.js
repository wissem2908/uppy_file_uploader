// const Uppy = require('@uppy/core')
// const Dashboard = require('@uppy/dashboard')
// const GoogleDrive = require('@uppy/google-drive')
// const Dropbox = require('@uppy/dropbox')
// const Instagram = require('@uppy/instagram')
// const Facebook = require('@uppy/facebook')
// const OneDrive = require('@uppy/onedrive')
// const Webcam = require('@uppy/webcam')
// const ScreenCapture = require('@uppy/screen-capture')
// const ImageEditor = require('@uppy/image-editor')
// const Tus = require('@uppy/tus')
// const Url = require('@uppy/url')
// const DropTarget = require('@uppy/drop-target')
// const GoldenRetriever = require('@uppy/golden-retriever')

const StatusBar = Uppy.StatusBar
const Informer = Uppy.Informer
const Webcam = Uppy.Webcam
const Dashboard = Uppy.Dashboard
const GoogleDrive = Uppy.GoogleDrive
const Dropbox = Uppy.Dropbox
const Instagram = Uppy.Instagram
const Facebook = Uppy.Facebook
const OneDrive = Uppy.OneDrive
const ScreenCapture = Uppy.ScreenCapture
const ImageEditor = Uppy.ImageEditor
const Tus = Uppy.Tus
const DropTarget = Uppy.DropTarget
const GoldenRetriever = Uppy.GoldenRetriever
const XHRUpload = Uppy.XHRUpload

const uppy = new Uppy.Core({
    id: 'uppy',
    autoProceed: false,
    allowMultipleUploads: true,
    debug: false,
    restrictions: {
      maxFileSize: null,
      minFileSize: null,
      maxTotalFileSize: null,
      maxNumberOfFiles: null,
      minNumberOfFiles: null,
      allowedFileTypes: ['image/*', 'video/*']
    },
    meta: {},
    onBeforeFileAdded: (currentFile, files) => currentFile,
    onBeforeUpload: (files) => {},
    locale: {},
    // store: new DefaultStore(),
    // logger: justErrorsLogger,
    infoTimeout: 5000
})
.use(Dashboard, {
  trigger: '.UppyModalOpenerBtn',
  inline: true,
  target: '.uppy-container',
  replaceTargetContent: true,
  showProgressDetails: true,
  note: 'Images and video only, 2–3 files, up to 1 MB',
  height: 470,
  metaFields: [
    { id: 'name', name: 'Name', placeholder: 'file name' },
    { id: 'caption', name: 'Caption', placeholder: 'describe what the image is about' }
  ],
  browserBackButtonClose: false
})
.use(GoogleDrive, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
.use(Dropbox, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
.use(Instagram, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
.use(Facebook, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
.use(OneDrive, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
.use(Webcam, { target: Dashboard })
.use(ScreenCapture, { target: Dashboard })
.use(ImageEditor, { target: Dashboard })
// .use(Tus, { endpoint: 'https://tusd.tusdemo.net/files/' })
.use(DropTarget, {target: document.body })
.use(GoldenRetriever)
uppy.use(XHRUpload, {
    endpoint: './upload_hanlder.php'
})


uppy.on('complete', result => {
    document.location.reload();
  console.log('successful files:', result.successful)
  console.log('failed files:', result.failed)
})