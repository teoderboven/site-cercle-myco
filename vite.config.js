import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd(), '');

    return {
        resolve: {
            alias: {
                '@': path.resolve(import.meta.dirname, './resources/scss'),
                '@@': path.resolve(import.meta.dirname, './resources'),
            },
            tsconfigPaths: true,
        },
        plugins: [
            laravel({
                input: [
                    'resources/scss/app.scss',
                    'resources/js/app.ts',
                    'resources/scss/activities.scss',
                    'resources/js/activities.ts',
                ],
                refresh: true,
            }),
        ],
        server: {
            host: '0.0.0.0',
            port: 5173,
            strictPort: true,
            cors: true,
            hmr: {
                host: env.VITE_HMR_HOST || 'localhost',
            },
            watch: {
                ignored: ['**/storage/framework/views/**'],
            },
        },
    }
});